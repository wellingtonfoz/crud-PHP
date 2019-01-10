'use strict';

/**
 * 
 */
angular.module('localization', [])
    // localization service responsible for retrieving resource files from the server and
    // managing the translation dictionary
    .factory('localize', ['$rootScope', '$window', "$log", "$locale", function ($rootScope, $window, $log, $locale) {

        var localize = {
            // array to hold the localized resource string entries
            dictionary:[],
            // flag to indicate if the service hs loaded the resource file
            resourceFileLoaded:false,

            /**
             * success handler for all server communication 
             * @param data
             */
            successCallback:function (data) {
                // store the returned array in the dictionary
                localize.dictionary = data;
                // set the flag that the resource are loaded
                localize.resourceFileLoaded = true;
                // broadcast that the file has been loaded
                $rootScope.$broadcast('localizeResourcesUpdates');
            },

            /**
             * allows setting of language on the fly 
             * @param value
             */
            setLanguage: function(value) {
            	$locale.code = value;
                localize.initLocalizedResources();
            },

            /**
             *  loads the language resource file from the server
             */
            initLocalizedResources:function () {
            	
            	if ( $rootScope.bundlePath == null ) {
            		$log.error("Incorrect Localize plugin configuration. $rootScope.bundlePath  is invalid. ->", $rootScope.bundlePath);
            	}
            	
            	if ( $rootScope.bundleFiles == null || $rootScope.bundleFiles.lenght == 0 ) {
            		$log.error("Incorrect Localize plugin configuration. $rootScope.bundleFiles is invalid. ->", $rootSc);
            	}
            	
            	if ( $locale.code == null ) {
            		$log.error("Incorrect Localize plugin configuration. $locale.code is invalid. ->", $locale.code);
            	}

//                $.i18n.properties({
//                    name: $rootScope.bundleFiles[0], //FIXME Make sure that we can do a loop to load all bundles
//                    path: $rootScope.bundlePath,
//                    mode: 'map',
//                    cache: true,
//                    language: $locale.code,
//                    callback: function() {
//                        localize.successCallback($.i18n.map);
//                    }
//                });
            },

            /**
             * checks the dictionary for a localized resource string 
             * @param value
             * @return
             */
            getLocalizedString: function(value) {
                return $.i18n.prop(value);
            }
        };

        // force the load of the resource file
        localize.initLocalizedResources();

        // return the local instance when called
        return localize;
    } ])
    // simple translation filter
    // usage {{ TOKEN | i18n }}
    .filter('i18n', ['localize', function (localize) {
        return function (input) {
            return localize.getLocalizedString(input);
        };
    }])
    
    /**
     * translation directive that can handle dynamic strings
     * updates the text value of the attached element
     * usage <span i18n="TOKEN" ></span>
     * or
     * <span i18n="TOKEN|VALUE1|VALUE2" ></span>
     */
    .directive('i18n', ['localize', function(localize) {
    	
        var i18nDirective = {
            restrict:"EAC",
            /**
             * 
             * @param element
             * @param token
             */
            updateText:function(element, token){
                var values = token.split('|');
                if (values.length >= 1) {
                    // construct the tag to insert into the element
                    var tag = localize.getLocalizedString(values[0]);
                    // update the element only if data was returned
                    if ((tag !== null) && (tag !== undefined) && (tag !== '')) {
                        if (values.length > 1) {
                            for (var index = 1; index < values.length; index++) {
                                var target = '{' + (index - 1) + '}';
                                tag = tag.replace(target, values[index]);
                            }
                        }
                        // insert the text into the element
                        element.text(tag);
                    };
                }
            },
            /**
             * 
             * @param scope
             * @param element
             * @param attrs
             */
            link:function (scope, element, attrs) {
                scope.$on('localizeResourcesUpdates', function() {
                    i18nDirective.updateText(element, attrs.i18n);
                });

                attrs.$observe('i18n', function (value) {
                    i18nDirective.updateText(element, attrs.i18n);
                });
            }
        };

        return i18nDirective;
    }])
    
    /**
     * translation directive that can handle dynamic strings
     * updates the attribute value of the attached element
     * usage <span data-i18n-attr="TOKEN|ATTRIBUTE" ></span>
     * or
     * <span data-i18n-attr="TOKEN|ATTRIBUTE|VALUE1|VALUE2" ></span> 
     */
    .directive('i18nAttr', ['localize', function (localize) {
        var i18NAttrDirective = {
            restrict: "EAC",
            /**
             * 
             * @param element
             * @param token
             */
            updateText:function(element, token){
                var values = token.split('|');
                // construct the tag to insert into the element
                var tag = localize.getLocalizedString(values[0]);
                // update the element only if data was returned
                if ((tag !== null) && (tag !== undefined) && (tag !== '')) {
                    if (values.length > 2) {
                        for (var index = 2; index < values.length; index++) {
                            var target = '{' + (index - 2) + '}';
                            tag = tag.replace(target, values[index]);
                        }
                    }
                    // insert the text into the element
                    element.attr(values[1], tag);
                }
            },
            /**
             * 
             * @param scope
             * @param element
             * @param attrs
             */
            link: function (scope, element, attrs) {
                scope.$on('localizeResourcesUpdated', function() {
                    i18NAttrDirective.updateText(element, attrs.i18nAttr);
                });

                attrs.$observe('i18nAttr', function (value) {
                    i18NAttrDirective.updateText(element, value);
                });
            }
        };

        return i18NAttrDirective;
    }]);