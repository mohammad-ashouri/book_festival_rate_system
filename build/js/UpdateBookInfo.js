function sendwork(post_id, work, data) {
    $.ajax({
        url: "build/php/inc/UpdatePostInfo.php",
        type: "POST",
        data: {
            "postID": post_id,
            "work": work,
            "data": data
        },
        success: function (response) {
            console.log(response);
            if (response == 'Done') {
                // console.clear();
            }
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
}


document.getElementById('postNameForEdit').onchange = function () {
    sendwork(post_id.value, "updateName", postNameForEdit.value);
}

document.getElementById('postTypeForEdit').onchange = function () {
    sendwork(post_id.value, "updatePostType", postTypeForEdit.value);
}

document.getElementById('languageForEdit').onchange = function () {
    sendwork(post_id.value, "updateLanguage", languageForEdit.value);
}

document.getElementById('publisherForEdit').onchange = function () {
    sendwork(post_id.value, "updatePublisher", publisherForEdit.value);
}

document.getElementById('ISSNForEdit').onchange = function () {
    sendwork(post_id.value, "updateISSN", ISSNForEdit.value);
}
document.getElementById('numberOfCoversForEdit').onchange = function () {
    sendwork(post_id.value, "updateNumberOfCovers", numberOfCoversForEdit.value);
}
document.getElementById('circulationForEdit').onchange = function () {
    sendwork(post_id.value, "updateCirculation", circulationForEdit.value);
}
document.getElementById('bookSizeForEdit').onchange = function () {
    sendwork(post_id.value, "updateBookSize", bookSizeForEdit.value);
}

document.getElementById('thesisCertificateNumberForEdit').onchange = function () {
    sendwork(post_id.value, "updateThesisCertificateNumber", thesisCertificateNumberForEdit.value);
}

document.getElementById('thesisDefencePlaceForEdit').onchange = function () {
    sendwork(post_id.value, "updateThesisDefencePlace", thesisDefencePlaceForEdit.value);
}

document.getElementById('thesisGradeForEdit').onchange = function () {
    sendwork(post_id.value, "updateThesisGrade", thesisGradeForEdit.value);
}
document.getElementById('thesisSupervisorForEdit').onchange = function () {
    sendwork(post_id.value, "updateThesisSupervisor", thesisSupervisorForEdit.value);
}
document.getElementById('thesisAdvisorForEdit').onchange = function () {
    sendwork(post_id.value, "updateThesisAdvisor", thesisAdvisorForEdit.value);
}
document.getElementById('pagesNumberForEdit').onchange = function () {
    sendwork(post_id.value, "updatePagesNumber", pagesNumberForEdit.value);
}
document.getElementById('specialSectionForEdit').onchange = function () {
    sendwork(post_id.value, "updateSpecialSection", specialSectionForEdit.value);
}
document.getElementById('propertiesForEdit').onchange = function () {
    sendwork(post_id.value, "updateProperties", propertiesForEdit.value);
}
document.getElementById('research_typeForEdit').onchange = function () {
    if (research_typeForEdit.value == 'چند رشته ای') {
        scientificGroup2THForEdit.hidden = false;
        scientificGroup2TDForEdit.hidden = false;
    } else if (research_typeForEdit.value == 'تک رشته ای') {
        scientificGroup2THForEdit.hidden = true;
        scientificGroup2TDForEdit.hidden = true;
        sendwork(post_id.value, "updateResearchType", research_typeForEdit.value);
    }
}

document.getElementById('scientificGroup1ForEdit').onchange = function () {
    sendwork(post_id.value, "updateScientificGroup1", scientificGroup1ForEdit.value);
}
document.getElementById('scientificGroup2ForEdit').onchange = function () {
    if (scientificGroup2ForEdit.value !== null && scientificGroup2ForEdit.value != 'انتخاب کنید') {
        sendwork(post_id.value, "updateScientificGroup2", scientificGroup2ForEdit.value);
    }
}
document.getElementById('activityTypeForEdit').onchange = function () {
    sendwork(post_id.value, "updateActivityType", activityTypeForEdit.value);
}
document.getElementById('postDeliveryMethodForEdit').onchange = function () {
    if (postDeliveryMethodForEdit.value == 'physical') {
        filesTR1ForEdit.hidden = true;
        filesTR2ForEdit.hidden = true;
        sendwork(post_id.value, "updatePostDeliveryMethod", postDeliveryMethodForEdit.value);
    } else if (postDeliveryMethodForEdit.value == 'digital') {
        filesTR1ForEdit.hidden = false;
        filesTR2ForEdit.hidden = false;
    }
}

document.getElementById('fNameForEdit').onchange = function () {
    sendwork(post_id.value, "updateFName", fNameForEdit.value);
}
document.getElementById('lNameForEdit').onchange = function () {
    sendwork(post_id.value, "updateLName", lNameForEdit.value);
}
document.getElementById('mobileForEdit').onchange = function () {
    sendwork(post_id.value, "updateMobile", mobileForEdit.value);
}
document.getElementById('genderForEdit').onchange = function () {
    sendwork(post_id.value, "updateGender", genderForEdit.value);
}
document.getElementById('shparvandetahsiliForEdit').onchange = function () {
    sendwork(post_id.value, "updateshparvandetahsili", shparvandetahsiliForEdit.value);
}