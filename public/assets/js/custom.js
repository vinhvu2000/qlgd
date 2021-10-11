var hash = location.hash.replace(/^#/, ''); 
if (hash) {
    $('.nav-tabs a[href="#' + hash + '"]').tab('show');
} 
$('.nav-tabs a').on('shown.bs.tab', function (e) {
    window.location.hash = e.target.hash;
})