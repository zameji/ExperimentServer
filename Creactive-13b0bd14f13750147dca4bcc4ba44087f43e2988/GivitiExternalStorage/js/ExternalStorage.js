/// <reference path='../definitions/jquery/jquery.d.ts' />
var it;
(function (it) {
    var marionegri;
    (function (marionegri) {
        var givitiweb;
        (function (givitiweb) {
            var ExternalStorage = (function () {
                function ExternalStorage(translationURL, dataStorageURL) {
                    this.SERVICE_URL_TRANSLATIONS = translationURL;
                    this.SERVICE_URL_DATASTORAGE = dataStorageURL;
                    this.EXTERNAL_APPLICATION = "Creactive Ambulatory FollowUp";
                }
                /** Load all translations contained inside a translationsManager block for a given culture */
                ExternalStorage.prototype.loadTranslations = function (blockName, culture) {
                    var _this = this;
                    this.currentCulture = culture;
                    var method = "GetLastKeysFromBlock";
                    var promise = $.ajax({
                        type: "GET",
                        async: true,
                        url: this.SERVICE_URL_TRANSLATIONS + method + "?applicationName=" + this.EXTERNAL_APPLICATION + "&blockName=" + blockName + "&culture=" + culture,
                        contentType: "application/json; charset=utf-8",
                        dataType: 'json',
                        cache: false,
                        processData: false,
                    });
                    var englishPromise = $.ajax({
                        type: "GET",
                        async: true,
                        url: this.SERVICE_URL_TRANSLATIONS + method + "?applicationName=" + this.EXTERNAL_APPLICATION + "&blockName=" + blockName + "&culture=en-US",
                        contentType: "application/json; charset=utf-8",
                        dataType: 'json',
                        cache: false,
                        processData: false,
                    });
                    var bothPromises = $.when(promise, englishPromise);
                    bothPromises.then(function (data, englishData) {
                        _this.dictionary = {};
                        _this.dictionary[culture] = data[0]["d"];
                        _this.dictionary["en-US"] = englishData[0]["d"];
                    });
                    return bothPromises;
                };
                ExternalStorage.prototype.getTranslation = function (key) {
                    if (this.dictionary == null || !(this.currentCulture in this.dictionary)) {
                        return "";
                    }
                    for (var element in this.dictionary[this.currentCulture]) {
                        if (this.dictionary[this.currentCulture][element]['Key'] == key) {
                            return this.dictionary[this.currentCulture][element]['Value'];
                        }
                    }
                    for (var element in this.dictionary["en-US"]) {
                        if (this.dictionary["en-US"][element]['Key'] == key) {
                            return this.dictionary["en-US"][element]['Value'];
                        }
                    }
                    return key;
                };
                /** Save JsonData to db inside a jsonName table with a dynamically generated GUID as key */
                ExternalStorage.prototype.saveData = function (jsonName, jsonData) {
                    var method = "CreateDataStorageValue";
                    var deferred = $.Deferred();
                    var guidPromise;
                    var myGuid = ExternalStorage.createGUID();
                    var listResult = $.ajax({
                        type: 'POST',
                        url: this.SERVICE_URL_DATASTORAGE + method,
                        data: JSON.stringify({ tableName: jsonName + 'List', guid: myGuid, value: '"' + PageUtils.getAdmissionKey() + '"' }),
                        cache: false,
                        processData: false,
                        contentType: 'application/json; charset=UTF-8',
                        async: true
                    });
                    var result = $.ajax({
                        type: 'POST',
                        url: this.SERVICE_URL_DATASTORAGE + method,
                        data: JSON.stringify({ tableName: jsonName, guid: myGuid, value: JSON.stringify(jsonData) }),
                        cache: false,
                        processData: false,
                        contentType: 'application/json; charset=UTF-8',
                        async: true
                    });
                    $.when(result)
                        .done(function (data) { return deferred.resolve(myGuid); })
                        .fail(function (error) { return deferred.reject(error); });
                    return deferred.promise();
                };
                /** Create a new GUID used to save data inside DB */
                ExternalStorage.createGUID = function () {
                    var guid = ExternalStorage.s4() + ExternalStorage.s4() + '-' + ExternalStorage.s4() + '-' + ExternalStorage.s4() + '-' + ExternalStorage.s4() + '-' + ExternalStorage.s4() + ExternalStorage.s4() + ExternalStorage.s4();
                    return guid;
                };
                /** Helper function to return an emptyGUID */
                ExternalStorage.getEmptyGUID = function () {
                    return "00000000-0000-0000-0000-000000000000";
                };
                /** Helper function to generate the random part of a GUID */
                ExternalStorage.s4 = function () {
                    return Math.floor((1 + Math.random()) * 0x10000).toString(16).substring(1);
                };
                return ExternalStorage;
            }());
            givitiweb.ExternalStorage = ExternalStorage;
            //NOTE!!!: This is a copy of PageUtils and UriUtils classes, so it's right to maintain the error
            var PageUtils = (function () {
                function PageUtils() {
                }
                /** Searches variable in query string and returns its value */
                PageUtils.getQueryVariable = function (variable) {
                    var query = window.location.search.substring(1); // needed to avoid question mark
                    var vars = query.split('&');
                    for (var i = 0; i < vars.length; i++) {
                        var pair = vars[i].split('=');
                        if (decodeURIComponent(pair[0]) == variable) {
                            return decodeURIComponent(pair[1]);
                        }
                    }
                };
                PageUtils.getPageData = function (index) {
                    var pageData = [];
                    try {
                        var encodedData = PageUtils.getQueryVariable("data");
                        var decodedData = window.atob(encodedData);
                        pageData = JSON.parse(decodedData);
                    }
                    catch (e) {
                        console.log("An error occurred while reading data page: the query part of the URL is malformed? Error:" + e.message);
                    }
                    if (index < pageData.length) {
                        return pageData[index];
                    }
                    else {
                        console.log("Index " + index + " not found in URL query data");
                        return null;
                    }
                };
                PageUtils.getAdmissionKey = function () {
                    return PageUtils.getPageData(0);
                };
                PageUtils.getAge = function () {
                    return PageUtils.getPageData(1);
                };
                PageUtils.getListOfLanguages = function () {
                    var admissionKey = PageUtils.getPageData(0);
                    var nationCode = admissionKey.substr(admissionKey.indexOf("-") + 1, 2);
                    switch (nationCode) {
                        case "IT":
                            return ["it-IT", "en-US"];
                        case "IL":
                            return ["he-IL", "ar-IL", "en-US"];
                        case "PL":
                            return ["pl-PL", "en-US"];
                        case "SI":
                            return ["sl-SL", "en-US"];
                        default:
                            return ["en-US"];
                    }
                };
                return PageUtils;
            }());
            givitiweb.PageUtils = PageUtils;
        })(givitiweb = marionegri.givitiweb || (marionegri.givitiweb = {}));
    })(marionegri = it.marionegri || (it.marionegri = {}));
})(it || (it = {}));
