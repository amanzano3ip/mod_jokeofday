// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * @author  2024 3iPunt <https://www.tresipunt.com/>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/* eslint-disable no-unused-vars */
/* eslint-disable no-console */
/* eslint-disable no-debugger */

define([
    'jquery',
    'core/str',
    'core/ajax',
    'core/templates'
], function(
    $,
    Str,
    Ajax,
    Templates, ) {

    /**
     *
     */
    let ACTION = {
        SCORE_SELECT: '[data-action="score"]'
    };

    /**
     *
     */
    let SERVICES = {
        SCORE: 'mod_jokeofday_joke_score'
    };

    /**
     * @param {String} region
     * @param {Integer} id
     * @param {Integer} cmid
     * @constructor
     */
    function Joke(region, id, cmid) {
        this.node = $(region);
        this.id = id;
        this.cmid = cmid;
        this.node.find(ACTION.SCORE_SELECT).on('change', this.scoreSelectChange.bind(this));
    }

    Joke.prototype.scoreSelectChange = function (e) {
        let $target = $(e.currentTarget);
        const value = $target.val();

        // Realizar llamada AJAX.
        const request = {
            methodname: SERVICES.SCORE,
            args: {
                jokeid: this.id,
                score: value,
                cmid: this.cmid
            }
        };

        Ajax.call(([request]))[0]
            .done(function (response) {
                if (response.success) {
                    console.log('LA PETICIÓN ES CORRECTA');
                    console.log(response.data);
                } else {
                    console.log(response.error);
                }
        }).fail(function (fail) {
            console.log(fail);
        });

    };

    Joke.prototype.node = null;

    return {

        /**
         * @param {String} region
         * @param {Integer} id
         * @param {Integer} cmid
         * @returns {Joke}
         */
        initJoke: function(region, id, cmid) {
            return new Joke(region, id, cmid);
        }

    };
});
