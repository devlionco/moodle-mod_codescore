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
 * JS actions.
 *
 * @module      mod_codescore/reports
 * @copyright   2024 Devlion <info@devlion.co>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

import Tabulator from 'mod_codescore/tabulatorlib';
import {get_string as getString} from 'core/str';

export const init = async(data) => {
    const rawParams = window.location.search;
    const urlParams = new URLSearchParams(rawParams);
    const cmid = urlParams.get('id') ? urlParams.get('id') : urlParams.get('cmid');
    const link = (cell) => {
        const name = cell.getValue();
        const index = Number(cell.getRow().getIndex());
        const attempt = cell.getRow().getData().attempt;
        let userid;
        if (document.getElementById('page-mod-codescore-view')) {
            userid = data.attempts[0].userid;
        }
        else {
            userid = cell.getRow().getData().userid;
        }
        cell.getRow().getElement().addEventListener('click', () => {
            window.location.href = `report.php?cmid=${cmid}&userid=${userid}&attempt=${attempt}&index=${index}`;
        });

        return `<a href='report.php?cmid=${cmid}&userid=${userid}&attempt=${attempt}&index=${index}'>` + name + "</a>";
    };

    const dateFormatter = (cell) => {
        const value = cell.getValue();
        const toDate = new Date(Number(value) * 1000).toString();
        return toDate.split('GMT')[0];
    };

    const gradeFormatter = (cell) => {
        const value = cell.getValue();
        return Number(value);
    };

    const deleteFormatter = (cell) => {
        const index = cell.getRow().getIndex();
        return `<input type="checkbox" data-id="${index}" class="tabulatorSelect"/>`;
    };

    if (!data.attempts[0]) {
        document.getElementsByClassName('reportTitle')[0].className += ' hidden';
        document.getElementById('tableWrapper').className += ' hidden';
        let noReports = await getString('noreports', 'codescore');
        if (document.getElementById('page-mod-codescore-reports')) {
            document.querySelector("[role=main]").innerHTML = `<h3>${noReports}</h3>`;
        }
    }
    let tabledata = data.attempts;
    let table = new Tabulator("#tableWrapper", {
        data: tabledata, //assign data to table
        layout: "fitColumns", //fit columns to width of table (optional)
        columns: [ //Define Table Columns
            {
                title: "", field: "deletebtn", width: 10, formatter: deleteFormatter,
                hozAlign: "center", vertAlign: 'center', headerSort: false
            },
            { title: await getString('tablename', 'codescore'), field: "username", width: 150, formatter: link },
            { title: await getString('startedat', 'codescore'), field: "timestart", hozAlign: "left", formatter: dateFormatter },
            { title: await getString('tablenotes', 'codescore'), field: "studentnotes" },
            { title: await getString('syntaxgradetable', 'codescore'), field: "syntaxgrading" },
            { title: await getString('outputgradetable', 'codescore'), field: "outputgrading" },
            { title: await getString('problemgradetable', 'codescore'), field: "problemsolutiongrading" },
            { title: await getString('casesgradetable', 'codescore'), field: "allcasesgrading" },
            { title: await getString('tableaigrade', 'codescore'), field: "aigrade", formatter: gradeFormatter },
            { title: await getString('tableteachergrade', 'codescore'), field: "grade", formatter: gradeFormatter },
        ],
    });
    //Event listeners

    table.on("renderComplete", () => {
        document.querySelectorAll('.tabulatorSelect').forEach((el) => {
            el.addEventListener('click', (e) => {
                const id = el.dataset.id;
                table.getRow(Number(id)).toggleSelect();
                const deleteBtn = document.getElementById('deleteAttempts');
                if (!table.getSelectedData()[0]) {
                    deleteBtn.className = 'disabled btn btn-secondary mb-2';
                }
                else {
                    deleteBtn.className = 'btn btn-secondary mb-2';
                }
                e.stopPropagation();
            });
        });
    });
    document.getElementById('deleteAttemptsConfirm').addEventListener('click', () => {
        // eslint-disable-next-line curly
        if (!table.getSelectedData()) return;
        const selected = table.getSelectedData().map((el) => {
            return el.id;
        });
        window.location.href = `delete_attempts.php?ids=${selected.join(",")}&cmid=${cmid}`;
    });
    if (!data.candelete) {
        table.on("tableBuilt", function () {
            table.getColumns()[0].delete();
        });
    }
};