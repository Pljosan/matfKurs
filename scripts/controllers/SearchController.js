'use strict';

matfApp.controller('SearchController', ['$scope', 'LyricsService', '$stateParams', function ($scope, LyricsService, $stateParams) {
        //$scope.linkovi = [];
        //var promise = LyricsService.getAllSongs();
        //promise.then(function(response){
        //  $scope.linkovi = response.data;
        // });
        $scope.linkovi = LyricsService.getSongsBySearch($stateParams.name);
}]);
