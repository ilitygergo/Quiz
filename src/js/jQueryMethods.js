$(document).ready(function(){
    $("#btn-edit-profile").click(function () {
        $('.flip').find('.card').addClass('flipped');
    });

    $("#btn-cancel-profile").click(function () {
        $('.flip').find('.card').removeClass('flipped');
    });
});
