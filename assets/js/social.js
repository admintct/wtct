function CreateBookmarkLink(){
    var title = document.title;
    var url = document.location.href;

    if(window.sidebar){
        /* Mozilla Firefox Bookmark */
        window.sidebar.addPanel(title, url, "");
    }else{
        /* Other */
        bootbox.alert('Press Control + D to bookmark');
    }
}
