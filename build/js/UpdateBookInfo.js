// const updateJournal = document.querySelector('#updateJournal');
// updateJournal.addEventListener('click', function () {
//     var name = $("#editedName").val();
//
//     if (name === '') {
//         alert('نام نشریه وارد نشده است');
//         return false;
//     } else {
//         if (confirm("اطلاعات قبلی در مورد نشریه '" +
//             $("#editedName").val() +
//             "' پس از تایید شما دیگر قابل استفاده نمی باشد." +
//             "ضمنا اطلاعات نشریه نسخه هایی که وارد شده اند تغییر نخواهد کرد." +
//             "\n" +
//             " آیا تایید می کنید؟")) {
//             $.ajax({
//                 url: "build/php/inc/EditJournal.php",
//                 type: "POST",
//                 data: {
//                     //Mag_Info
//                     editedName: name,
//                     postID: $("#postID").val(),
//                     editedScienceRank: science_rank,
//                     editedScientificGroup: scientific_group,
//                     editedInternationalPosition: international_position,
//                     editedMagType: type,
//                     editedPublicationPeriod: publication_period,
//                     editedISSN: ISSN,
//                     editedMagState: mag_state,
//                     editedMagCity: mag_city,
//                     editedMagAddress: mag_address,
//                     editedMagPhone: mag_phone,
//                     editedMagFax: $("#editedMagFax").val(),
//                     editedMagEmail: mag_email,
//                     editedWebsite: $("#editedWebsite").val(),
//                     editedConcessionaireType: concessionaire_type,
//                     editedConcessionaire: concessionaire,
//
//                     //responsible_manager_owner
//                     editedResponsibleManagerOwnerSubject: responsible_manager_owner_subject,
//                     editedResponsibleManagerOwnerName: responsible_manager_owner_name,
//                     editedResponsibleManagerOwnerFamily: responsible_manager_owner_family,
//                     editedResponsibleManagerOwnerDegree: responsible_manager_owner_degree,
//                     editedResponsibleManagerOwnerPhone: responsible_manager_owner_phone,
//                     editedResponsibleManagerOwnerMobile: responsible_manager_owner_mobile,
//                     editedResponsibleManagerOwnerAddress: $("#editedResponsibleManagerOwnerAddress").val(),
//
//                     //responsible_manager_owner
//                     editedChiefEditorSubject: chief_editor_subject,
//                     editedChiefEditorName: chief_editor_name,
//                     editedChiefEditorFamily: chief_editor_family,
//                     editedChiefEditorDegree: chief_editor_degree,
//                     editedChiefEditorPhone: chief_editor_phone,
//                     editedChiefEditorMobile: chief_editor_mobile,
//                     editedChiefEditorAddress: $("#editedChiefEditorAddress").val(),
//
//                     //administration_manager
//                     editedAdministrationManagerSubject: administration_manager_subject,
//                     editedAdministrationManagerName: administration_manager_name,
//                     editedAdministrationManagerFamily: administration_manager_family,
//                     editedAdministrationManagerDegree: administration_manager_degree,
//                     editedAdministrationManagerPhone: administration_manager_phone,
//                     editedAdministrationManagerMobile: administration_manager_mobile,
//                     editedAdministrationManagerAddress: $("#editedAdministrationManagerAddress").val(),
//                 },
//                 success: function (response) {
//                     alert('نشریه انتخاب شده با موفقیت ویرایش شد');
//                     location.reload();
//                 }
//             });
//         }
//     }
//
// });

function sendwork(post_id,work,data){
    $.ajax({
        url: "build/php/inc/UpdatePostInfo.php",
        type: "POST",
        data: {
            "postID":post_id,
            "work":work,
            "data":data
        },
        success: function (response) {
            console.log(response);
            if (response=='Done'){
                console.clear();
            }
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
}

document.getElementById('postNameForEdit').oninput=function (){
    sendwork(post_id.value,"updateName",postNameForEdit.value);
}
