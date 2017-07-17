$(".search").keyup(function(e) {
	search = $(this);
    var contacts = $(".contact");
    contacts.each(function() {
    	contact = $(this);
    	contact_name = contact.find(".contact-name").text().toUpperCase();
    	filter = search.val().toUpperCase();
        if (contact_name.indexOf(filter) > -1) {
            contact.show();
        } else {
            contact.hide();
        }
    });
});