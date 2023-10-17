$(document).ready(function() {
    initEvents();
});

function initEvents() {
    $('.app_container-content-information--content-total .app_container-content-information-btn').click(function() {
        $('.popup').show()
    });

    $('.popup__footer .popup__btn-close').click(closePopup)

}

function closePopup() {
    $(this).parents(".popup").hide()
}