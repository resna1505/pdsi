document.addEventListener('DOMContentLoaded', function() {
    // Global variables
    var calendarEl = document.getElementById('calendar');
    var eventModal = new bootstrap.Modal(document.getElementById('event-modal'));
    var isEditMode = false;
    var currentEvent = null;
    var eventCategoryChoice = null;
    var dateRangePicker = null;
    
    // CSRF Token setup
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    // Initialize Flatpickr
    initializeFlatpickr();
    
    // Initialize Choices.js for category dropdown
    if (document.getElementById('event-category')) {
        eventCategoryChoice = new Choices('#event-category', {
            searchEnabled: false,
            allowHTML: true
        });
    }

    // Initialize Calendar
    var calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
        },
        initialView: 'dayGridMonth',
        themeSystem: 'bootstrap',
        events: '/events',
        selectable: true,
        editable: true,
        droppable: true,
        dayMaxEvents: true,
        
        // Event click handler
        eventClick: function(info) {
            // Check if user owns this event
            // if (info.event.extendedProps.anggota_id) {
                showEventDetails(info.event);
            // } else {
            //     showToast('You can only edit your own events', 'warning');
            // }
        },
        
        // Date select handler
        select: function(info) {
            let startDate = info.startStr;
            let endDate = info.endStr;
            
            // For multi-day selection
            if (startDate !== endDate) {
                // Calculate actual end date (FullCalendar adds 1 day to end date)
                let actualEndDate = new Date(endDate);
                actualEndDate.setDate(actualEndDate.getDate() - 1);
                endDate = actualEndDate.toISOString().split('T')[0];
            }
            
            openEventModal('create', {
                start_date: startDate,
                end_date: startDate !== endDate ? endDate : null,
                all_day: info.allDay
            });
        },
        
        // Event drop handler - dengan authorization check
        eventDrop: function(info) {
            if (info.event.extendedProps.anggota_id) {
                updateEventDate(info.event);
            } else {
                info.revert(); // Revert the change
                showToast('You can only move your own events', 'warning');
            }
        },
        
        // Event resize handler - dengan authorization check
        eventResize: function(info) {
            if (info.event.extendedProps.anggota_id) {
                updateEventDate(info.event);
            } else {
                info.revert(); // Revert the change
                showToast('You can only resize your own events', 'warning');
            }
        }
    });

    calendar.render();

    // Load upcoming events on page load
    loadUpcomingEvents();

    // Event Handlers
    document.getElementById('btn-new-event').addEventListener('click', function() {
        openEventModal('create');
    });

    document.getElementById('form-event').addEventListener('submit', function(e) {
        e.preventDefault();
        if (isEditMode) {
            updateEvent();
        } else {
            createEvent();
        }
    });

    document.getElementById('btn-delete-event').addEventListener('click', function() {
        if (currentEvent) {
            deleteEvent(currentEvent.id);
        }
    });

    // Functions
    function initializeFlatpickr() {
        // Date range picker dengan fix untuk multi-date
        dateRangePicker = flatpickr('#event-start-date', {
            mode: 'range',
            dateFormat: 'Y-m-d',
            allowInput: true,
            onChange: function(selectedDates, dateStr, instance) {
                console.log('Date selected:', dateStr, selectedDates);
                
                if (selectedDates.length === 2) {
                    // Range selected - hide time inputs for all-day events
                    document.getElementById('event-time').style.display = 'none';
                    console.log('Range mode: hiding time inputs');
                } else if (selectedDates.length === 1) {
                    // Single date - show time inputs
                    document.getElementById('event-time').style.display = 'block';
                    console.log('Single date mode: showing time inputs');
                }
            }
        });

        // Time pickers
        flatpickr('#timepicker1', {
            enableTime: true,
            noCalendar: true,
            dateFormat: 'H:i',
            time_24hr: true
        });

        flatpickr('#timepicker2', {
            enableTime: true,
            noCalendar: true,
            dateFormat: 'H:i',
            time_24hr: true
        });
    }

    function showEventDetails(event) {
        currentEvent = event;
        isEditMode = false;
        
        // Show event details, hide form
        document.querySelector('.event-details').style.display = 'block';
        document.querySelector('.event-form').style.display = 'none';
        
        // Populate details
        document.getElementById('event-start-date-tag').textContent = formatDate(event.start);
        document.getElementById('event-timepicker1-tag').textContent = event.extendedProps.start_time || '';
        document.getElementById('event-timepicker2-tag').textContent = event.extendedProps.end_time || '';
        document.getElementById('event-location-tag').textContent = event.extendedProps.location || 'No Location';
        document.getElementById('event-description-tag').textContent = event.extendedProps.description || 'No Description';
        
        document.getElementById('modal-title').textContent = event.title;
        document.getElementById('btn-save-event').style.display = 'none';
        document.getElementById('btn-delete-event').style.display = 'block';
        document.getElementById('edit-event-btn').style.display = 'block';
        
        eventModal.show();
    }

    function openEventModal(mode, data = {}) {
        isEditMode = mode === 'edit';
        currentEvent = data.event || null;
        
        // Reset form
        document.getElementById('form-event').reset();
        
        // Clear date picker
        if (dateRangePicker) {
            dateRangePicker.clear();
        }
        
        // Show form, hide details
        document.querySelector('.event-details').style.display = 'none';
        document.querySelector('.event-form').style.display = 'block';
        
        // Set form values if editing
        if (mode === 'edit' && currentEvent) {
            document.getElementById('event-title').value = currentEvent.title;
            document.getElementById('event-description').value = currentEvent.extendedProps.description || '';
            document.getElementById('event-location').value = currentEvent.extendedProps.location || '';
            document.getElementById('eventid').value = currentEvent.id;
            
            if (eventCategoryChoice) {
                eventCategoryChoice.setChoiceByValue(currentEvent.extendedProps.category || 'bg-primary-subtle');
            }
            
            // Set date range untuk edit
            let dateValue = formatDateForInput(currentEvent.start);
            if (currentEvent.end && currentEvent.allDay) {
                // For all-day events with end date
                let endDate = new Date(currentEvent.end);
                endDate.setDate(endDate.getDate() - 1); // FullCalendar adds 1 day
                dateValue += ' to ' + endDate.toISOString().split('T')[0];
            }
            
            dateRangePicker.setDate(dateValue);
            
            // Set times if available
            if (currentEvent.extendedProps.start_time) {
                document.getElementById('timepicker1').value = currentEvent.extendedProps.start_time;
            }
            if (currentEvent.extendedProps.end_time) {
                document.getElementById('timepicker2').value = currentEvent.extendedProps.end_time;
            }
        }
        
        // Set initial date if creating new event
        if (data.start_date) {
            let dateValue = data.start_date;
            if (data.end_date) {
                dateValue += ' to ' + data.end_date;
                // Hide time inputs for range
                document.getElementById('event-time').style.display = 'none';
            } else {
                // Show time inputs for single date
                document.getElementById('event-time').style.display = 'block';
            }
            
            dateRangePicker.setDate(dateValue);
        }
        
        document.getElementById('modal-title').textContent = mode === 'create' ? 'Add Event' : 'Edit Event';
        document.getElementById('btn-save-event').textContent = mode === 'create' ? 'Add Event' : 'Update Event';
        document.getElementById('btn-save-event').style.display = 'block';
        document.getElementById('btn-delete-event').style.display = mode === 'create' ? 'none' : 'block';
        document.getElementById('edit-event-btn').style.display = 'none';
        
        eventModal.show();
    }

    function createEvent() {
        const formData = getFormData();
        console.log('Creating event with data:', formData);
        
        fetch('/events', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                calendar.refetchEvents();
                loadUpcomingEvents();
                eventModal.hide();
                showToast('Event created successfully', 'success');
            } else {
                showToast('Error creating event: ' + (data.message || 'Unknown error'), 'error');
                console.error('Error:', data);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('Error creating event', 'error');
        });
    }

    function updateEvent() {
        const formData = getFormData();
        console.log('Updating event with data:', formData);
        
        fetch(`/events/${currentEvent.id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                calendar.refetchEvents();
                loadUpcomingEvents();
                eventModal.hide();
                showToast('Event updated successfully', 'success');
            } else {
                showToast('Error updating event: ' + (data.message || 'Unknown error'), 'error');
                console.error('Error:', data);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('Error updating event', 'error');
        });
    }

    function deleteEvent(eventId) {
        if (confirm('Are you sure you want to delete this event?')) {
            fetch(`/events/${eventId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    calendar.refetchEvents();
                    loadUpcomingEvents();
                    eventModal.hide();
                    showToast('Event deleted successfully', 'success');
                } else {
                    showToast('Error deleting event: ' + (data.message || 'Unknown error'), 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error deleting event', 'error');
            });
        }
    }

    function updateEventDate(event) {
        let endDate = null;
        if (event.end) {
            let end = new Date(event.end);
            if (event.allDay) {
                end.setDate(end.getDate() - 1); // FullCalendar adds 1 day for all-day events
            }
            endDate = end.toISOString().split('T')[0];
        }

        const data = {
            start_date: formatDateForInput(event.start),
            end_date: endDate,
            start_time: event.extendedProps.start_time,
            end_time: event.extendedProps.end_time
        };

        console.log('Updating event date:', data);

        fetch(`/events/${event.id}/date`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                loadUpcomingEvents();
                showToast('Event date updated', 'success');
            } else {
                showToast('Error updating event date: ' + (data.message || 'Unknown error'), 'error');
                calendar.refetchEvents(); // Revert changes
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('Error updating event date', 'error');
            calendar.refetchEvents(); // Revert changes
        });
    }

    function loadUpcomingEvents() {
        fetch('/events/upcoming', {
            headers: {
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(events => {
            const container = document.getElementById('upcoming-event-list');
            container.innerHTML = '';
            
            if (events.length === 0) {
                container.innerHTML = '<p class="text-muted">No upcoming events</p>';
                return;
            }
            
            events.forEach(event => {
                const eventEl = document.createElement('div');
                eventEl.className = 'card mb-3';
                eventEl.innerHTML = `
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                                <i class="ri-calendar-event-line text-muted fs-16"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="card-title mb-1">${event.title}</h6>
                                <p class="text-muted mb-1">${event.date}</p>
                                <p class="text-muted mb-0">${event.time}</p>
                                ${event.location ? `<p class="text-muted mb-0"><i class="ri-map-pin-line"></i> ${event.location}</p>` : ''}
                            </div>
                        </div>
                    </div>
                `;
                container.appendChild(eventEl);
            });
        })
        .catch(error => {
            console.error('Error loading upcoming events:', error);
        });
    }

    function getFormData() {
        const dateRange = document.getElementById('event-start-date').value;
        const dates = dateRange.split(' to ');
        
        let startDate = dates[0];
        let endDate = dates.length > 1 ? dates[1] : null;
        let allDay = dates.length > 1; // Multi-day = all day
        
        // If no time specified for single day, consider it all day
        if (!endDate && !document.getElementById('timepicker1').value && !document.getElementById('timepicker2').value) {
            allDay = true;
        }
        
        const formData = {
            title: document.getElementById('event-title').value,
            description: document.getElementById('event-description').value,
            location: document.getElementById('event-location').value,
            category: document.getElementById('event-category').value,
            start_date: startDate,
            end_date: endDate,
            start_time: !allDay ? document.getElementById('timepicker1').value || null : null,
            end_time: !allDay ? document.getElementById('timepicker2').value || null : null,
            all_day: allDay
        };
        
        console.log('Form data prepared:', formData);
        return formData;
    }

    // Helper functions
    function formatDate(date) {
        return new Date(date).toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
    }

    function formatDateForInput(date) {
        return new Date(date).toISOString().split('T')[0];
    }

    function showToast(message, type) {
        // Simple alert for now - replace with your preferred notification system
        if (type === 'error') {
            alert('❌ ' + message);
        } else if (type === 'warning') {
            alert('⚠️ ' + message);
        } else {
            alert('✅ ' + message);
        }
    }

    // Make functions available globally for onclick handlers
    window.editEvent = function(button) {
        openEventModal('edit', { event: currentEvent });
    };
});