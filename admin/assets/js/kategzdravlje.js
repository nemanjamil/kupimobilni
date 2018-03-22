/*
 * custom.js
 *
 * Place your code here that you need on all your pages.
 */

"use strict";


$(document).ready(function () {

    /* =========  POCETAK ZTREE ZDRAVLJE ================ */

    var settingZdr = {

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
            chkboxType: {"Y": "", "N": ""},
            radioType: "all"
        },
        async: {
            enable: true,
            url: "/akcija.php?action=getNodesZdravlje",
            autoParam: ["id", "name", "pId"]
        },

        edit: {
            enable: true
        },
        view: {
            addHoverDom: addHoverDom22,
            addDiyDom: addDiyDom22,
            removeHoverDom: removeHoverDom22,
            //dblClickExpand: false, default je true
            selectedMulti: true
            // ovo znaci da mozemo da selektujemo vise nodova odjedamput - to nije checked node
        },
        callback: {

            beforeRemove: beforeRemove22,
            onRemove: onRemove22,
            onCheck: myOnCheck22
            //onClick: myOnClick22
            //beforeClick: myBeforeClick22
            /*
             beforeEditName: beforeEditName,
             beforeRename: beforeRename // kada ovo ukljcimo onda ne radi onRename: onRename
             */
        }


    };

    function myBeforeClick22(treeId, treeNode, clickFlag) {
        //return (treeNode.id !== 1);
        alert(treeNode.tId + ", " + treeNode.name);
    };

    function myOnClick22(event, treeId, treeNode) {
        //alert(treeNode.tId + ", " + treeNode.name);
        alert('Sve smo klikunuli - treba skinuti');
    };

    function myOnCheck22(event, treeId, treeNode) {
        //alert(treeNode.id + ", " + treeNode.name + "," + treeNode.checked);
        //var id = $("#id").val();
        var kategId = treeNode.id;
        var cek = treeNode.checked;

        var canDelete;
        var url = "/akcija.php?action=activeKategZdravlje"; // the script where you handle the form input.

        if (kategId) {
            $.ajax({
                type: "POST",
                url: url,
                dataType: "json",
                data: {id: kategId, cekiran : cek},
                success: function (response) {

                    if (response.ok) {
                        alert(response.ok);
                        canDelete = true;
                    } else {
                        alert(response.error);
                        canDelete = false;
                    }
                }
            });
        } else {
            alert('No id or Kateg Id');
        }

        return canDelete;

    };

    // kada se zavrsi beforeRemove onda ide onRremove
    function onRemove22(e, treeId, treeNode) {
        showLog("[ " + getTime() + " onRemove ]&nbsp;&nbsp;&nbsp;&nbsp; " + treeNode.name);
    }

    function beforeRemove22(treeId, treeNode) {


        var zTree = $.fn.zTree.getZTreeObj("treeHeadZdravlje");
        zTree.selectNode(treeNode);

        var r = confirm("Confirm delete node '" + treeNode.name + "'?");
        if (r == false) {
            return false;
        }

        var canDelete;

        var idartikla = treeNode.id;
        var parentId = treeNode.parentId;

        var url = "/akcija.php?action=obrisikategZdravlje"; // the script where you handle the form input.
        $.ajax({
            type: "POST",
            url: url,
            //dataType: "json",  // kada stavimo ovo onda nam ne radi jer dobijamo { ok:"Dodata kategorija"}  a bez toga dobijamo { "ok":"Dodata kategorija" }
            async: false, // pogledaj nemanjamil Setting async to false means that the statement you are calling has to complete before the next statement in your function can be called.
            data: {id: idartikla, br: parentId},
            success: function (response) {

                var obj = jQuery.parseJSON(response);
                if (obj.ok) {
                    alert(obj.ok);
                    canDelete = true;
                } else {
                    alert(obj.error);
                    canDelete = false;
                }
            }
        });

        return canDelete;
    }

    function addHoverDom22(treeId, treeNode) {

        var sObj = $("#" + treeNode.tId + "_span");

        if (treeNode.editNameFlag || $("#addBtn_" + treeNode.tId).length > 0) return;
        var addStr = "<span class='button add' id='addBtn_" + treeNode.tId
            + "' title='Dodaj kategoriju 22' onfocus='this.blur();'>";

        sObj.after(addStr);

        var btn = $("#addBtn_" + treeNode.tId);

        if (btn) btn.bind("click", function () {


            var zTree = $.fn.zTree.getZTreeObj("treeHeadZdravlje");
            var imenoda = "Ime Nove kategorije - promeni ime - " + (Math.random());

            //ovde sada upicavavo u bazu taj id sto smo kreirali
            var idartikla = treeNode.id;
            var parentId = treeNode.parentId;

            var url = "/akcija.php?action=dodajkategZdravlje";
            $.ajax({
                type: "POST",
                url: url,
                //dataType: "json",  // kada stavimo ovo onda nam ne radi jer dobijamo { ok:"Dodata kategorija"}  a bez toga dobijamo { "ok":"Dodata kategorija" }
                data: {id: idartikla, br: parentId, string: imenoda},
                success: function (response) {

                    var obj = jQuery.parseJSON(response);
                    if (obj.ok) {
                        zTree.addNodes(treeNode, {id: obj.id, pId: treeNode.id, name: imenoda});
                        alert(obj.ok);
                    } else {
                        alert(obj.error);
                    }

                }
            });

            return false;
        });
    };

    function addDiyDom22(treeId, treeNode) {
        var aObj = $("#" + treeNode.tId + "_span");
        if ($("#diyBtn_" + treeNode.tId).length > 0) return;

        var addStrf = "<span class='button addmoj' id='diyBtn_" + treeNode.tId
            + "' title='Izmeni kategoriju' onfocus='this.blur();'></span>";
        aObj.append(addStrf);

        var btn = $("#diyBtn_" + treeNode.tId);
        if (btn) btn.bind("click", function () {
            // alert("Kliknut id :  " + treeNode.idagro+' i '+treeNode.tId+' url : '+treeNode.url);

            var x = location.pathname; // /admin/kategorije
            var agro = location.host; //agro
            var protocol = location.protocol; // http:
            window.location.assign(protocol + '//' + agro + '/admin/' + treeNode.url);

        });
        return false;

    };

    function removeHoverDom22(treeId, treeNode) {
        $("#addBtn_" + treeNode.tId).unbind().remove();
    };

    function myOnCheckZdravlje(event, treeId, treeNode) {

        alert('aaa');

        return;

        var treeObjdodaj = $.fn.zTree.getZTreeObj("treeHeadZdravlje");
        var nodes = treeObjdodaj.getCheckedNodes(true);
        var idKategorijeDodajArtikal = nodes[0].id;
        $('#idkategorijeDodajArtikal').val(idKategorijeDodajArtikal);

        // Specfikacije artikala
        var sa = $('#spefikacijeArtikala');
        var url = "/akcija.php?action=dodajspecartikala"; // the script where you handle the form input.
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: {id: idKategorijeDodajArtikal},
            success: function (response) {

                // http://stackoverflow.com/questions/1208467/how-to-add-items-to-a-unordered-list-ul-using-jquery
                // $('#my_list').append.apply($('#my_list'), items);
                //var json = JSON.parse(jsonOsnovni);
                //var obj = jQuery.parseJSON(response);

                if (response.ok) {

                    var items = [];

                    $.each(response.ok, function (key, val) {

                        var sel = [];

                        $.each(val, function (kljuc, vrednost) {

                            var ime = vrednost.IdSpecVrednostiIme;
                            var id = vrednost.IdSpecVrednosti;

                            sel.push('<option value="' + id + '">' + ime + '</option>');
                            /* var obj = {};
                             obj[kljuc] = ime;
                             cities.push(obj);*/

                        });


                        items.push("<li><div>" + key + "</div><div class='specOdvoj'><select id='" + key + "' name='spec[]'>" + sel.join('') + "</select></div></li>");

                        // items.push.apply(items, sds);

                    });


                    var ij = items.join("");

                    var selectUl = $("<ul/>", {
                        "class": "my-new-list",
                        "name": "moja Moda",
                        html: ij
                    });


                    sa.html(selectUl);

                } else {
                    sa.html('');
                    //alert(response.error);
                }


            },
            error: function (xhr, status, thrown) {

                alert(error);

            }
        });

    };


    function myOnClickZdravlje(event, treeId, treeNode) {
        event.preventDefault();
        // alert(treeNode.tId + ", " + treeNode.name);
    };

    $.fn.zTree.init($("#treeHeadZdravlje"), settingZdr); // , zNodes


    /* =========   ZTREE KRAJ  ZDRAVLJE ================ */


    $('#kojisunod').click(function () {

        var treeObj = $.fn.zTree.getZTreeObj("treeHeadZdravlje");
        var nodes = treeObj.getCheckedNodes(true);

        var mojarrayKategObject = {};
        var mojarrayObican = Array();

        $.each(nodes, function (key, value) {
            mojarrayObican.push(value.id);
            mojarrayKategObject[value.name] = value.id;
        });

        var sta = mojarrayKategObject;
        console.log(sta);

        var obc = mojarrayObican;
        console.log(obc);

        /* ovo koristimo kada selektujemo vise nodova sa crtl i kliknemo misem na ime - !!! nije kada cekiramo box
         // mora da bide selektovano selectedMulti: true kod view
         var treeObj = $.fn.zTree.getZTreeObj("treeDemo");
         var gso = treeObj.getSelectedNodes();*/


    });


});





