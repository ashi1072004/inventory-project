"use strict";
function checkid(aid) {
    return $(aid).val().match(/^[1-9]+$/);
}

function checkalpha(aid) {
    var aname = $(aid).val();
    return aname.match(/^[a-zA-Z\s]*$/);
}

function checkdesc(aid) {
    var ades = $(aid).val();
    return ades.match(/^[a-zA-Z0-9 .'"?!,&()@_\-\\n\\r\\s]*$/) && !(ades.length < 3);
}

function checkemail(aid) {
    var aemail = $(aid).val();
    return aemail.match(/^[^\s@]+@[^\s@]+\.[^\s@]*$/);
}

function checkmob(aid) {
    // var regex = /^(\+92)3\d{2}-?\d{7}$/;
    var mobRegex = /^\+\d{1,2}(\s?|-?)\(?\d{1,4}\)?(\s?|-?)\d{2,3}-?\d{4,7}$/;
    var amob = $(aid).val();
    return mobRegex.test(amob);
}

function checkcode(aid) {
    var data = $(aid).val();
    return data.match(/^[0-9]+$/) && (data.length == 12);
}

function checkcost(aid) {
    var data = $(aid).val();
    return (data >= 0 && data <= 1000000000);
    // return data.match(/^(?:0|[1-9]\d{0,8}|1000000000)$/);
}

function checkstock(aid) {
    var data = $(aid).val();
    return (data >= 0 && data <= 1000);
}

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});
