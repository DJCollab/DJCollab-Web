function SearchSongs($search){
  $url= "https://api.spotify.com/v1/search?q="+$search+"&type=track&market=US&limit=4";
  $.getJSON($url, function(data) {
      $('#resultsList').html('');
      $(data.tracks.items).each(function() {
        $id = this.id;
        $image = this.album.images[2].url;
        $album = this.album.name;
        $title = this.name;
        $artists = [];
        $(this.artists).each(function() {
          $artists.push(this.name);
        });
        $artists = $artists.join(', ');
        $result = '<a href="'+$link+"/"+$id+'/"><img src="'+$image+'" class="albumImage" /><p>'+$title+'<br />'+$artists+'<br />'+$album+'</p></a>';
        $('#resultsList').append($result);
      });
  })
  .error(function() { alert("Error Searching Spotify"); });
}
