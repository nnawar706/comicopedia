$(document).ready(function() {
    $('#search').keyup(function() {
        $('#searchResult').html('');
        let searchField = $('#search').val();
        // console.log(searchField);

        let apiKey = "c704212b54af40b3af542df235f28ac3";

        fetch(`/api/search/autocomplete?text=${encodeURIComponent(searchField)}&limit=5&apiKey=${apiKey}`)
            .then(response => response.json())
            .then(data => {
                $.each(data, function (key, value) {
                    $('#searchResult').append('<div><a style="color: #1a202c" href="/volumes/' + value.volume_id + '">'+ value.item + ', ' + value.volume +'</a></div>');
                    console.log(data)
                })
            });
    })
})

document.addEventListener("click", function(event) {
    let targetDiv = document.getElementById("searchResult");

    if (!targetDiv.contains(event.target) && targetDiv.childElementCount > 0) {
        while(targetDiv.firstChild){
            targetDiv.removeChild(targetDiv.firstChild);
        }
    }
});
