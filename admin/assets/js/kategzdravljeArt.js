/*
 * custom.js
 *
 * Place your code here that you need on all your pages.
 */

"use strict";


$(document).ready(function () {

    var id = $("#id").val();

    /* =========  POCETAK ZTREE ZDRAVLJE ================ */

    var settingZdrArt = {

        data: {
            simpleData: {
                enable: true,
                idKey: "id",
                pIdKey: "pId",
                rootPId: null
            }
        },

        check: {
            enable: true,
            chkStyle: "checkbox", // radio
            chkboxType: {"Y": "", "N": ""}

        },
        async: {
            enable: true,
            url: "/akcija.php?action=getNodesZdravljeArt",
            autoParam: ["id", "name", "pId"],
            otherParam: { "br":id }
        },


        callback: {
            onCheck: myOnCheckZdravljettt
            //onClick: myOnClick22Edit
        }


    };


    function myOnClick22Edit(event, treeId, treeNode) {
        //alert(treeNode.tId + ", " + treeNode.name);
       // alert('Sve smo klikunuli - treba skinuti');


    };

    function myOnCheckZdravljettt(event, treeId, treeNode) {
        var id = $("#id").val();
        var kategId = treeNode.id;
        var cek = treeNode.checked;

        var canDelete;


        var url = "/akcija.php?action=kategZdravljenaArt"; // the script where you handle the form input.

        if (id && kategId) {
            $.ajax({
                type: "POST",
                url: url,
                dataType: "json",
                data: {id: id, br: kategId, cekiran : cek},
                success: function (response) {

                    if (response.ok) {
                        //alert(response.ok);
                        canDelete = true;
                    } else {
                        alert(response.error);
                        canDelete = false;
                    }
                }
            });
        }

        return canDelete;

    };



    $.fn.zTree.init($("#treeHeadZdravljeArtEdit"), settingZdrArt); // , zNodes



});





