'use strict';

matfApp.service('LyricsService', function ($http) {
    var self = this;
    var songs = [];

    // self.getAllSongs = function () {
    //     return $http.get("http://localhost/html/test.php");
    // };

    self.getAllSongs = function () {
        return songs;
    }

    self.getSongsBySearch = function(name) {
        //emptying the array before another search
        songs = [];
        $http({
            method: 'GET',
            url: "http://localhost/html/test.php",
            params: {"name": name}
        })
            .then(function (response) {
                var i;
                for (i = 0; i < response.data.length; i++) {
                    songs.push(response.data[i]);
                }
                console.log(response);
            });
        return songs;
    };

    self.getSongById = function (id) {
        for (var i = 0; i < songs.length; ++i) {
            if (songs[i].id != id) {
                continue;
            }

            return songs[i];
        }

        return null;
    };
});
