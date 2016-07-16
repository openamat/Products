/**
 * Created by antoninotocco on 16/07/16.
 */
'use strict';

module.exports = function () {

    var os = require('os');
    var ifaces = os.networkInterfaces();
    var result = "127.0.0.1";

    Object.keys(ifaces).some(function (ifname) {
        var found = false;

        ifaces[ifname].some(function (iface) {
            if ('IPv4' !== iface.family || iface.internal !== false) {
                return false;
            }
            result = iface.address;
            found = true;
            return true;
        });
        return found;
    });
    return result;
};