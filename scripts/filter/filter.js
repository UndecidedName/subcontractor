﻿subconApp.filter('Date', function ($filter) {
    return function (value) {
        if (value == "" || value == null)
            return "";
        return $filter('date')(value, "MM/dd/yyyy");
    }
});
subconApp.filter('DateTime', function ($filter) {
    return function (value) {
        if (value == "" || value == null)
            return "";
        return $filter('date')(value, "MM/dd/yyyy HH:mm:ss");
    }
});
subconApp.filter('Time', function ($filter) {
    return function (value) {
        if (value == "" || value == null)
            return "";
        return $filter('date')(value, "HH:mm:ss");
    }
});
subconApp.filter('Boolean', function ($filter) {
    return function (value) {
        if (value == true)
            return "Yes";
        else
            return "No";
    }
});
subconApp.filter('Default', function ($filter) {
    return function (value) {
        if (value == "" || value == null)
            return "";
        return value;
    }
});
subconApp.filter('StringUpper', function ($filter) {
    return function (value) {
        if (value == "" || value == null)
            return "";
        return value.toUpperCase();
    }
});
subconApp.filter('ProperCase', function ($filter) {
    return function (value) {
        if (value == "" || value == null)
            return "";
        var words = value.split(' ');
        for (var i = 0; i < words.length; i++) {
            words[i] = words[i].toLowerCase(); // lowercase everything to get rid of weird casing issues
            words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1);
        }
        return words.join(' ');
    }
});
subconApp.filter('Decimal', function ($filter) {
    return function (value) {
        if (value == "" || value == null)
            return "";
        else
            return value.toFixed(4);

    }
});
subconApp.filter('StatusMaintenance', function ($filter) {
    return function (value) {
        if (value == 1)
            return "Active";
        else
            return "Inactive";

    }
});