/*
Template Name: pdsi - Admin & Dashboard Template
Author: Themesbrand
Website: https://Themesbrand.com/
Contact: Themesbrand@gmail.com
File: contact init Js File
*/

var contactData = [
    {
        "id": 1,
        "user": {
            "img": "build/images/users/avatar-1.jpg",
            "name": "dr. Andi Setiawan"
        },
        "email": "andi.setiawan@pdsi.com",
        "phone": "+62 812 3456 7890",
        "area": "Jakarta",
        "label": "Dokter Umum",
        "tab" : "frequently",
    }, {
        "id": 2,
        "user": {
            "img": "build/images/users/avatar-2.jpg",
            "name": "dr. Siti Aminah"
        },
        "email": "siti.aminah@pdsi.com",
        "phone": "+62 813 4567 8901",
        "area": "Surabaya",
        "label": "Dokter Subspesialis",
        "tab" : "important",
    }, {
        "id": 3,
        "user": {
            "img": "build/images/users/avatar-3.jpg",
            "name": "dr. Budi Wibowo"
        },
        "email": "budi.wibowo@pdsi.com",
        "phone": "+62 811 2345 6789",
        "area": "Bandung",
        "label": "Dokter Umum",
        "tab" : "groups",
    }, {
        "id": 4,
        "user": {
            "img": "build/images/users/avatar-4.jpg",
            "name": "dr. Sri Wahyuni"
        },
        "email": "sri.wahyuni@pdsi.com",
        "phone": "+62 812 3456 7890",
        "area": "Yogyakarta",
        "label": "Dokter Subspesialis",
        "tab" : "trash",
    }, {
        "id": 5,
        "user": {
            "img": "build/images/users/avatar-5.jpg",
            "name": "dr. M. Fadli"
        },
        "email": "m.fadli@pdsi.com",
        "phone": "+62 813 4567 8901",
        "area": "Semarang",
        "label": "Dokter Umum",
        "tab" : "frequently",
    }, {
        "id": 6,
        "user": {
            "img": "build/images/users/avatar-6.jpg",
            "name": "dr. Retno Widayanti"
        },
        "email": "retno.widayanti@pdsi.com",
        "phone": "+62 811 2345 6789",
        "area": "Medan",
        "label": "Dokter Gigi",
        "tab" : "groups",
    }, {
        "id": 7,
        "user": {
            "img": "build/images/users/avatar-7.jpg",
            "name": "dr. Siti Fatimah"
        },
        "email": "siti.fatimah@pdsi.com",
        "phone": "+62 812 3456 7890",
        "area": "Palembang",
        "label": "Dokter Spesialis",
        "tab" : "groups",
    }, {
        "id": 8,
        "user": {
            "img": "build/images/users/avatar-8.jpg",
            "name": "dr. M. Ilyas"
        },
        "email": "m.ilyas@pdsi.com",
        "phone": "+62 813 4567 8901",
        "area": "Bogor",
        "label": "Dokter Umum",
        "tab" : "frequently",
    }, {
        "id": 9,
        "user": {
            "img": "build/images/users/avatar-9.jpg",
            "name": "dr. Sri Hartati"
        },
        "email": "sri.hartati@pdsi.com",
        "phone": "+62 811 2345 6789",
        "area": "Makassar",
        "label": "Dokter Gigi",
        "tab" : "frequently",
    }, {
        "id": 10,
        "user": {
            "img": "build/images/users/avatar-10.jpg",
            "name": "dr. Bambang S."
        },
        "email": "bambang.s@pdsi.com",
        "phone": "+62 812 3456 7890",
        "area": "Malang",
        "label": "Dokter Subspesialis",
        "tab" : "important",
    }, {
        "id": 11,
        "user": {
            "img": "build/images/users/avatar-1.jpg",
            "name": "dr. Endang S."
        },
        "email": "endang.s@pdsi.com",
        "phone": "+62 813 4567 8901",
        "area": "Solo",
        "label": "Dokter Umum",
        "tab" : "trash",
    }, {
        "id": 12,
        "user": {
            "img": "build/images/users/avatar-2.jpg",
            "name": "dr. M. Ali"
        },
        "email": "m.ali@pdsi.com",
        "phone": "+62 811 2345 6789",
        "area": "Pontianak",
        "label": "Dokter Gigi",
        "tab" : "",
    }, {
        "id": 13,
        "user": {
            "img": "build/images/users/avatar-3.jpg",
            "name": "dr. M. Iqbal"
        },
        "email": "m.iqbal@pdsi.com",
        "phone": "+62 812 3456 7890",
        "area": "Banjarmasin",
        "label": "Dokter Spesialis",
        "tab" : "",
    }, {
        "id": 14,
        "user": {
            "img": "build/images/users/avatar-4.jpg",
            "name": "dr. M. Zain"
        },
        "email": "m.zain@pdsi.com",
        "phone": "+62 813 4567 8901",
        "area": "Balikpapan",
        "label": "Dokter Subspesialis",
        "tab" : "",
    }, {
        "id": 15,
        "user": {
            "img": "build/images/users/avatar-5.jpg",
            "name": "dr. M. Taufiq"
        },
        "email": "m.taufiq@pdsi.com",
        "phone": "+62 811 2345 6789",
        "area": "Manado",
        "label": "Dokter Umum",
        "tab" : "",
    }, {
        "id": 16,
        "user": {
            "img": "build/images/users/avatar-6.jpg",
            "name": "dr. M. Yusuf"
        },
        "email": "m.yusuf@pdsi.com",
        "phone": "+62 812 3456 7890",
        "area": "Padang",
        "label": "Dokter Gigi",
        "tab" : "",
    }, {
        "id": 17,
        "user": {
            "img": "build/images/users/avatar-7.jpg",
            "name": "dr. M. Zulkifli"
        },
        "email": "m.zulkifli@pdsi.com",
        "phone": "+62 813 4567 8901",
        "area": "Samarinda",
        "label": "Dokter Spesialis",
        "tab" : "",
    }, {
        "id": 18,
        "user": {
            "img": "build/images/users/avatar-8.jpg",
            "name": "dr. M. Zainuddin"
        },
        "email": "m.zainuddin@pdsi.com",
        "phone": "+62 811 2345 6789",
        "area": "Tangerang",
        "label": "Dokter Umum",
        "tab" : "",
    }, {
        "id": 19,
        "user": {
            "img": "build/images/users/avatar-9.jpg",
            "name": "dr. M. Husni"
        },
        "email": "m.husni@pdsi.com",
        "phone": "+62 812 3456 7890",
        "area": "Bekasi",
        "label": "Dokter Gigi",
        "tab" : "",
    }, {
        "id": 20,
        "user": {
            "img": "build/images/users/avatar-10.jpg",
            "name": "dr. M. Rizal"
        },
        "email": "m.rizal@pdsi.com",
        "phone": "+62 813 4567 8901",
        "area": "Cirebon",
        "label": "Dokter Subspesialis",
        "tab" : "",
    }
];

function sortElementsById() {
    var manymember = contactData.sort(function (a, b) {
        var x = fetchIdFromObj(a);
        var y = fetchIdFromObj(b);

        if (x > y) {
            return -1;
        }
        if (x < y) {
            return 1;
        }
        return 0;
    })
}
sortElementsById();

var editlist = false;
// recomended-jobs
if (document.getElementById("recomended-jobs")) {
    var contactList = new gridjs.Grid({
        columns: [
            {
                name: 'Name',
                data: (function (row) {
                    return gridjs.html('<div class="d-flex align-items-center">\
						<div class="flex-shrink-0 me-2">\
						<div class="avatar-xs rounded-circle"><img src="' + row.user.img + '" alt="" class="img-fluid rounded-circle d-block user-img"></div>\
						</div>\
						<div class="flex-grow-1">\
						<h6 class="fw-medium mb-1 user-name">' + row.user.name + '</h6>\
						</div>\
						</div>');
                }),

            },
            {
                name: 'Email',
            },
            {
                name: 'Phone'
            },
            {
                name: 'Area'
            },
            {
                name: 'Profesi',
                data: (function (row) {
                    return gridjs.html(isStatus(row.label));
                })
            }, {
                name: 'Action',
                width: '150px',
                data: (function (row) {
                    return gridjs.html('<div class="d-flex align-items-center gap-2 justify-content-center">\
                        <div><a href="#viewContactoffcanvas" data-bs-toggle="offcanvas" onClick="overviewList()" class="text-muted px-1 d-block viewlist-btn"><i class="bi bi-eye-fill"></i></a></div>\
                        <div><a href="#addContactModal" data-bs-toggle="modal" onClick="editMemberList('+ row.id + ')"  class="text-muted px-1 d-block"><i class="bi bi-pencil-fill"></i></a></div>\
                        <div><a href="#removeContactModal" data-bs-toggle="modal" class="text-muted px-1 d-block" onClick="removeItem('+ row.id + ')"><i class="bi bi-trash-fill"></i></a></div>\
						</div>');
                })
            },
        ],
        sort: true,
        pagination: {
            limit: 10
        },
        data: contactData,
    }).render(document.getElementById("recomended-jobs"));
};


function isStatus(val) {
    switch (val) {
        case "Dokter Umum":
            return ('<span class="badge badge-soft-success">' + val + "</span>");
        case "Dokter Gigi":
            return ('<span class="badge badge-soft-secondary">' + val + "</span>");
        case "Dokter Spesialis":
            return ('<span class="badge badge-soft-info">' + val + "</span>");
        case "Dokter Subspesialis":
            return ('<span class="badge badge-soft-danger">' + val + "</span>");
    }
}



// contact image
document.querySelector("#contact-image-input").addEventListener("change", function () {
    var preview = document.querySelector("#contact-img");
    var file = document.querySelector("#contact-image-input").files[0];
    var reader = new FileReader();
    reader.addEventListener("load", function () {
        preview.src = reader.result;
    }, false);
    if (file) {
        reader.readAsDataURL(file);
    }
});


// Form Event
(function () {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    event.preventDefault();
                    var userImg = document.getElementById("contact-img").src;
                    var inputName = document.getElementById('name').value;
                    var inputEmail = document.getElementById('email').value;
                    var inputPhone = document.getElementById('phoneNumber').value;
                    var inputArea = document.getElementById('area').value;
                    var inputlabel = document.getElementById('label').value;

                    if (inputName !== "" && inputEmail !== "" && inputPhone !== "" && inputArea !== "" && !editlist) {
                        var newMemberId = findNextId();
                        var newMember = {
                            'id': newMemberId,
                            "user": {
                                "img": userImg,
                                "name": inputName
                            },
                            "email": inputEmail,
                            "phone": inputPhone,
                            "area": inputArea,
                            "label": inputlabel
                        };

                        contactData.push(newMember);
                        sortElementsById();
                    } if (inputName !== "" && inputEmail !== "" && inputPhone !== "" && inputArea !== "" && editlist) {
                        var getEditid = 0;
                        getEditid = document.getElementById("contactid-input").value;
                        contactData = contactData.map(function (item) {
                            if (item.id == getEditid) {
                                var editObj = {
                                    'id': getEditid,
                                    "user": {
                                        "img": userImg,
                                        "name": inputName
                                    },
                                    "email": inputEmail,
                                    "phone": inputPhone,
                                    "area": inputArea,
                                    "label": inputlabel
                                }
                                return editObj;
                            }
                            return item;
                        });
                        editlist = false;
                    }

                    contactList.updateConfig({
                        data: contactData
                    }).forceRender();

                    document.getElementById("addContact-btnClose").click();
                }
                form.classList.add('was-validated');
            }, false)
        })
})()

function fetchIdFromObj(member) {
    return parseInt(member.id);
}

function findNextId() {
    if (contactData.length === 0) {
        return 0;
    }
    var lastElementId = fetchIdFromObj(contactData[contactData.length - 1]),
        firstElementId = fetchIdFromObj(contactData[0]);
    return (firstElementId >= lastElementId) ? (firstElementId + 1) : (lastElementId + 1);
}


Array.from(document.querySelectorAll(".addContact-modal")).forEach(function (elem) {
    elem.addEventListener('click', function (event) {
      document.getElementById("addContactModalLabel").innerHTML = "Add Contact";
      document.getElementById("addNewContact").innerHTML = "Add Contact";
      document.getElementById("name").value = "";
      document.getElementById("email").value = "";
      document.getElementById("phoneNumber").value = "";
      document.getElementById("area").value = "";
      document.getElementById("label").value = "";

      document.getElementById("contact-img").src = "build/images/users/user-dummy-img.jpg";
      document.getElementById("contactlist-form").classList.remove('was-validated');
    });
});


function editMemberList(elem) {
    var getEditid = elem;
    contactData = contactData.map(function (item) {
        if (item.id == getEditid) {
            editlist = true;
            document.getElementById("addContactModalLabel").innerHTML = "Edit Contact";
            document.getElementById("addNewContact").innerHTML = "Save";

            document.getElementById("contactid-input").value = item.id;
            document.getElementById("contact-img").src = item.user.img;
            document.getElementById("name").value = item.user.name;
            document.getElementById("email").value = item.email;
            document.getElementById("phoneNumber").value = item.phone;
            document.getElementById("area").value = item.area;
            document.getElementById("label").value = item.label;
        }
        return item;
    });
}

// removeItem event
function removeItem(elem) {
    var getid = elem;
    document.getElementById("remove-contact").addEventListener("click", function () {
        function arrayRemove(arr, value) {
            return arr.filter(function (ele) {
                return ele.id != value;
            });
        }
        var filtered = arrayRemove(contactData, getid);

        contactData = filtered;
        contactList.updateConfig({
            data: contactData
        }).forceRender();

        document.getElementById("removeContactModalbtn-close").click();
    });
}


// overviewList event
function overviewList(){
    var rowElem = event.target.parentElement.closest(".gridjs-tr");

    var userImg = rowElem.querySelector(".user-img").src;
    var userName = rowElem.querySelector(".user-name").innerHTML;
    var userEmail = rowElem.querySelector("[data-column-id='email']").innerHTML;
    var userPhone = rowElem.querySelector("[data-column-id='phone']").innerHTML;
    var userArea = rowElem.querySelector("[data-column-id='area']").innerHTML;
    var userLabel = rowElem.querySelector("[data-column-id='label'] .badge").innerHTML;

    document.querySelector("#viewContactoffcanvas .overview-userimg").src = userImg;
    document.querySelectorAll("#viewContactoffcanvas .overview-name").forEach(function(elem){
        elem.innerHTML = userName;
    });
    document.querySelector("#viewContactoffcanvas .overview-email").innerHTML = userEmail;
    document.querySelector("#viewContactoffcanvas .overview-phone").innerHTML = userPhone;
    document.querySelectorAll("#viewContactoffcanvas .overview-location").forEach(function(elem){
        elem.innerHTML = userArea;
    });
    document.querySelector("#viewContactoffcanvas .overview-tags").innerHTML = userLabel;
}



// Search result list
var searchProductList = document.getElementById("searchResultList");
searchProductList.addEventListener("keyup", function () {
	var inputVal = searchProductList.value.toLowerCase();
	function filterItems(arr, query) {
		return arr.filter(function (el) {
			return el.user.name.toLowerCase().indexOf(query.toLowerCase()) !== -1 || el.email.toLowerCase().indexOf(query.toLowerCase()) !== -1 || el.phone.toLowerCase().indexOf(query.toLowerCase()) !== -1 || el.area.toLowerCase().indexOf(query.toLowerCase()) !== -1 || el.label.toLowerCase().indexOf(query.toLowerCase()) !== -1
		})
	}

	var filterData = filterItems(contactData, inputVal);

	contactList.updateConfig({
		data: filterData
	}).forceRender();
});


// contact list filter menu

Array.from(document.querySelectorAll('.contact-menu-list a')).forEach(function (menuTab) {
    menuTab.addEventListener("click", function () {
        if (menuTab.querySelector('.menu-list-link').hasAttribute('data-tab')) {
            var tabname = menuTab.querySelector('.menu-list-link').getAttribute("data-tab");
            if (tabname != 'all') {
                var filterData = contactData.filter(list => list.tab === tabname);
            } else {
                var filterData = contactData;
            }

        }else if (menuTab.querySelector('.menu-list-link').hasAttribute('data-label')) {
            var tabname = menuTab.querySelector('.menu-list-link').getAttribute("data-label");
            var filterData = contactData.filter(list => list.label === tabname);
        }

        var activeListTab = document.querySelector('.contact-menu-list a.active')
        if (activeListTab) {
            activeListTab.classList.remove("active")
        }
        menuTab.classList.add("active")

        contactList.updateConfig({
            data: filterData
        }).forceRender();
    });
})
