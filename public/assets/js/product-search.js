$(document).ready(function() {
    $('#search').keyup(function() {
        $('#searchResult').html('');
        let searchField = $('#search').val();
        // console.log(searchField);

        let apiKey = "c704212b54af40b3af542df235f28ac3";

        fetch(`/api/search/autocomplete?text=${encodeURIComponent(searchField)}&limit=5&apiKey=${apiKey}`)
            .then(response => response.json())
            .then(data => {
                console.log(data.map(value => value.volume));
            });
    })
})
