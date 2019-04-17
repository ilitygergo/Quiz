$(document).ready(function(){
    $("#btn-edit-profile").click(function () {
        $('.flip').find('.card').addClass('flipped');
    });

    $("#btn-my-stat-profile").click(function () {
        console.log('my-stat');
    });

    $("#btn-save-profile").click(function () {
        $('.flip').find('.card').removeClass('flipped');
    });

    $("#btn-cancel-profile").click(function () {
        $('.flip').find('.card').removeClass('flipped');
    });
});
