"use strict";

/**
 * Captcha
 */
angular.module("captcha-directive",[])
    .directive("captcha", function (){
    	return {
            scope: { valid: '=' },
            template: '<span class="input" style="padding: 5px 30px; background-color: #EDEDED!important;">{{a}}&nbsp;{{operation}}&nbsp;{{b}}</span>&nbsp;=&nbsp;<input class="input" ng-model="result.answer" style="width:90px; text-align: center;padding-left:0px;">',
            controller: function($scope, $log) {
                $scope.a = Math.floor(Math.random()*10) + 1;
                $scope.b = Math.floor(Math.random()*10) + 1;
                $scope.operation = '+';

                $scope.result = {
                		value : $scope.a + $scope.b,
                		answer : null
                };
                var checkValidity = function(){
                	var answer = $scope.result.answer;
                    var result = $scope.result.value;
                    if (answer) {
                        $scope.valid = answer == result;
                    } else {
                        $scope.valid = false;
                    }
//                    $scope.$apply(); // needed to solve 2 cycle delay problem
                };
                $scope.$watch('result.answer', function(){
                    checkValidity();
                });
            }
    	};
});