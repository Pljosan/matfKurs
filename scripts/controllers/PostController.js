'use strict';

matfApp.controller('PostController', ['$scope', '$http', function ($scope, $http) {

    $scope.songName = '';
    $scope.songAuthor = '';
    $scope.songLyrics = '';

    $scope.submit = function() {
        var name = this.songName;
        var author = this.songAuthor;
        var text = this.songLyrics;

        $http({
            method: 'POST',
            url: "http://localhost/html/postLyricsAjaxService.php",
            data: {
                "name": name,
                "author": author,
                "text": text
            },
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}

        })
            .then(function (response) {
                console.log(response.data);
            });

        $scope.songName = '';
        $scope.songAuthor = '';
        $scope.songLyrics = '';

        //$http.get("http://localhost/html/postLyricsAjaxService.php?name="+$scope.songName);
    }

}]);
