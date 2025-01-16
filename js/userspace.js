
var current_section_id = "";

function showSection(sectionId) {
    // var sections = document.querySelectorAll('.infoperso, .infostage, .infotuteur, .infoentreprise');
    // sections.forEach(function(section) {
    //     section.style.display = 'none';
        
    // });


    if (current_section_id != sectionId)
    {
        if (current_section_id != "")
        {
            var selectedSection = document.getElementById(current_section_id);
            selectedSection.style.display = 'none';

            var selectedNavSection = document.getElementById("nav_"+current_section_id);
            selectedNavSection.style.backgroundColor = "transparent";
            selectedNavSection.style.borderRadius = "5px";
            console.log("nav_"+current_section_id);
        }
        

        selectedSection = document.getElementById(sectionId);
        selectedSection.style.display = 'block';

        selectedNavSection = document.getElementById("nav_"+sectionId);
        selectedNavSection.style.backgroundColor = " #ad947e";

        current_section_id = sectionId;
    }
    

}

showSection("info");