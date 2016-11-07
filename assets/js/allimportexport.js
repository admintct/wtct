function allimportexport(event) {
    if (event.keyCode == 13) {
//        alert("pp");
        //code to execute here
//        searchAndHighlight($(search-term).val());
        $("#skypechat").hide();
        if(!searchAndHighlight($('#search-term').val())) {
            alert("No results found");
        }    
        $("#skypechat").show();
        return false;
    }
    return true;
}