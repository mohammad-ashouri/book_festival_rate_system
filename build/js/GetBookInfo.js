function getInfo(id) {
    $.ajax({
        url: "build/ajax/GetBookAllInfo.php",
        type: "GET",
        data: {
            id: id,
            name: ''
        },
        success: function (response) {
            if (response.postFormat==='کتاب'){
                bookTR1ForEdit.hidden=false;
                bookTR2ForEdit.hidden=false;
                thesisTR1ForEdit.hidden=true;
                thesisTR2ForEdit.hidden=true;
            }else if (response.postFormat==='پایان نامه'){
                thesisTR1ForEdit.hidden=false;
                thesisTR2ForEdit.hidden=false;
                bookTR1ForEdit.hidden=true;
                bookTR2ForEdit.hidden=true;
            }
            //Post_Info
            $("#postNameForEdit").val(response.postName);
            $("#postID").val(response.id);
            $("#postFormatForEdit").val(response.postFormat).trigger('change');
            $("#postTypeForEdit").val(response.postType).trigger('change');
            $("#languageForEdit").val(response.language).trigger('change');
            $("#pagesNumberForEdit").val(response.pagesNumber);
            $("#specialSectionForEdit").val(response.specialSection);
            $("#propertiesForEdit").val(response.properties);
            let wordCount = document.getElementById("wordCountForEdit");
            if (response.properties === "") {
                wordCount.textContent = "تعداد کلمات: " + 0;
            } else {
                const text = response.properties.trim();
                const words = text.split(/\s+/);
                let wordCountValue = words.length;
                wordCount.textContent = "تعداد کلمات: " + wordCountValue;
            }

            //Book
            $("#publisherForEdit").val(response.publisher).trigger('change');
            $("#bookSizeForEdit").val(response.bookSize).trigger('change');
            $("#ISSNForEdit").val(response.ISSN);
            $("#numberOfCoversForEdit").val(response.numberOfCovers);
            $("#circulationForEdit").val(response.circulation);

            //Thesis
            $("#thesisCertificateNumberForEdit").val(response.thesisCertificateNumber);
            $("#thesisDefencePlaceForEdit").val(response.thesisDefencePlace);
            $("#thesisGradeForEdit").val(response.thesisGrade);
            $("#thesisSupervisorForEdit").val(response.thesisSupervisor);
            $("#thesisAdvisorForEdit").val(response.thesisAdvisor);

            //Research_Type
            $("#research_typeForEdit").val(response.research_type).trigger('change');
            $("#scientificGroup1ForEdit").val(response.scientificGroup1).trigger('change');
            if (response.scientificGroup2!==null){
                scientificGroup2THForEdit.hidden=false;
                scientificGroup2TDForEdit.hidden=false;
                $("#scientificGroup2ForEdit").val(response.scientificGroup2).trigger('change');
            }else{
                scientificGroup2THForEdit.hidden=true;
                scientificGroup2TDForEdit.hidden=true;
            }

            //Activity_Type
            $("#activityTypeForEdit").val(response.activityType).trigger('change');
            if (response.activityType==='مشترک'){
                cooperatorsTableForEdit.hidden=false;
            }else{
                cooperatorsTableForEdit.hidden=true;
            }

            //Delivery_Method
            if (response.postDeliveryMethod==='نسخه فیزیکی') {
                $("#postDeliveryMethodForEdit").val('physical').trigger('change');
                filesTR1ForEdit.hidden=true;
                filesTR2ForEdit.hidden=false;
                thesisFileTH1ForEdit.hidden=true;
                thesisFileTH2ForEdit.hidden=true;
                thesisFileTDForEdit.hidden=true;
            }else {
                $("#postDeliveryMethodForEdit").val('digital').trigger('change');
                filesTR1ForEdit.hidden=false;
                postFileURL.setAttribute("href", response.file_src);
                if (response.postFormat==='پایان نامه'){
                    filesTR2ForEdit.hidden=false;
                    thesisFileTH1ForEdit.hidden=false;
                    thesisFileTH2ForEdit.hidden=false;
                    thesisFileTDForEdit.hidden=false;
                    thesisFileURL.setAttribute("href", response.thesis_proceedings_src);
                }
            }

            //Person Info
            $("#fNameForEdit").val(response.fName);
            $("#lNameForEdit").val(response.lName);
            $("#national_codeForEdit").val(response.national_code);
            $("#mobileForEdit").val(response.mobile);
            $("#genderForEdit").val(response.gender).trigger('change');
            $("#shparvandetahsiliForEdit").val(response.shparvandetahsili);

            $("#post_id").val(response.id);
        }
    });
}
