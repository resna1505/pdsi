document.addEventListener('DOMContentLoaded', function() {
    // Global variables
    var calendarEl = document.getElementById('calendar');
    var eventModal = new bootstrap.Modal(document.getElementById('event-modal'));
    var isEditMode = false;
    var currentEvent = null;
    var eventCategoryChoice = null;
    
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
            showEventDetails(info.event);
        },
        
        // Date select handler
        select: function(info) {
            openEventModal('create', {
                start_date: info.startStr,
                all_day: info.allDay
            });
        },
        
        // Event drop handler
        eventDrop: function(info) {
            updateEventDate(info.event);
        },
        
        // Event resize handler
        eventResize: function(info) {
            updateEventDate(info.event);
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
        // Date picker
        flatpickr('#event-start-date', {
            mode: 'range',
            dateFormat: 'Y-m-d',
            onChange: function(selectedDates, dateStr, instance) {
                const dates = dateStr.split(' to ');
                if (dates.length > 1) {
                    // Range selected - hide time inputs
                    document.getElementById('event-time').style.display = 'none';
                } else {
                    // Single date - show time inputs
                    document.getElementById('event-time').style.display = 'block';
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
            
            // Set date
            document.getElementById('event-start-date').value = formatDateForInput(currentEvent.start);
            
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
            document.getElementById('event-start-date').value = data.start_date;
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
                showToast('Error creating event', 'error');
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
                showToast('Error updating event', 'error');
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
                    showToast('Error deleting event', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error deleting event', 'error');
            });
        }
    }

    function updateEventDate(event) {
        const data = {
            start_date: formatDateForInput(event.start),
            start_time: event.extendedProps.start_time,
            end_time: event.extendedProps.end_time
        };

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
                showToast('Error updating event date', 'error');
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
        
        return {
            title: document.getElementById('event-title').value,
            description: document.getElementById('event-description').value,
            location: document.getElementById('event-location').value,
            category: document.getElementById('event-category').value,
            start_date: dates[0],
            start_time: document.getElementById('timepicker1').value || null,
            end_time: document.getElementById('timepicker2').value || null,
            all_day: dates.length > 1 || (!document.getElementById('timepicker1').value && !document.getElementById('timepicker2').value)
        };
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
        // Simple console log for now - replace with your preferred notification system
        console.log(`${type.toUpperCase()}: ${message}`);
        
        // You can implement a proper toast notification here
        alert(message);
    }

    // Make functions available globally for onclick handlers
    window.editEvent = function(button) {
        openEventModal('edit', { event: currentEvent });
    };
});