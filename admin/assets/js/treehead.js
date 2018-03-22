"use strict";

$(document).ready(function () {


    /* =========  POCETAK ZTREEHEAD HEAD KATEGORIJE ================ */


    var settingHeadKateg = {

        check: {
            enable: true,
            chkStyle: "checkbox", // radio
            chkboxType: {"Y": "", "N": ""}
            //radioType: "all"
        },
        async: {
            enable: true,
            url: "/akcija.php?action=getNodesKategHead",
            autoParam: ["id", "name", "level=lv", "parentId"],
            otherParam: {"otherParam": "zTreeAsyncKategorije"}

        },

        view: {
            addHoverDom: addHoverDomHead,
            addDiyDom: addDiyDomHead,
            //removeHoverDom: removeHoverDom,
            //dblClickExpand: false, default je true
            selectedMulti: true
            // ovo znaci da mozemo da selektujemo vise nodova odjedamput - to nije checked node
        },
        edit: {
            enable: true,
            editNameSelectAll: true,
            //showRemoveBtn: showRemoveBtn,
            //showRenameBtn: showRenameBtn
            beforeRemove: beforeRemoveHead
        },
        callback: {
            beforeRemove: beforeRemoveHead,
            onRemove: onRemove,

        }

    };

    function onRemove(e, treeId, treeNode) {
        showLog("[ " + getTime() + " onRemove ]&nbsp;&nbsp;&nbsp;&nbsp; " + treeNode.name);
    }

//napraviti obrisi head!
    function beforeRemoveHead(treeId, treeNode) {

        var zTree = $.fn.zTree.getZTreeObj("treeHead");
        zTree.selectNode(treeNode);

        var r = confirm("Confirm delete node '" + treeNode.name + "'?");
        if (r == false) {
            return false;
        }

        var canDelete;

        var idartikla = treeNode.id;
        var parentId = treeNode.parentId;

        var url = "/akcija.php?action=obrisikateghead";
        $.ajax({
            type: "POST",
            url: url,
            async: false,
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

    // ovde sam dodao custom ikonicu - zvezda.  Kada se klikne na nju oda se otvareju detalji date kategorije

    function addDiyDomHead(treeId, treeNode) {
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
            window.location.assign(protocol + '//' + agro + '/admin/str/' + treeNode.url);

        });
        return false;

    };

    function addHoverDomHead(treeId, treeNode) {

        var sObj = $("#" + treeNode.tId + "_span");

        if (treeNode.editNameFlag || $("#addBtn_" + treeNode.tId).length > 0) return;
        var addStr = "<span class='button add' id='addBtn_" + treeNode.tId
            + "' title='Dodaj kategoriju' onfocus='this.blur();'>";

        sObj.after(addStr);

        var btn = $("#addBtn_" + treeNode.tId);


        if (btn) btn.bind("click", function () {


            var zTree = $.fn.zTree.getZTreeObj("treeDemo");
            var imenoda = "Ime Nove kategorije - promeni ime - " + (Math.random());

            //ovde sada upicavavo u bazu taj id sto smo kreirali
            var idartikla = treeNode.id;
            var parentId = treeNode.parentId;


            var x = location.pathname; // /admin/kategorije
            var agro = location.host; //agro
            var protocol = location.protocol; // http:
            window.location.assign(protocol + '//' + agro + '/admin/str/dodajKategHead/' + idartikla);

            /* var url = "/akcija.php?action=dodajkategHead";
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
             });*/

            return false;
        });
    };

/*    var curStatus = "init", curAsyncCount = 0, asyncForAll = false,
        goAsync = false;

    function expandAll() {

        if (!check()) {
            return;
        }
        var zTree = $.fn.zTree.getZTreeObj("treeHead");
        if (asyncForAll) {
            // $("#demoMsg").text(demoMsg.expandAll);
            zTree.expandAll(true);
        } else {
            expandNodes(zTree.getNodes());
            if (!goAsync) {
                // $("#demoMsg").text(demoMsg.expandAll);
                curStatus = "";
            }
        }
    }

    function check() {
        if (curAsyncCount > 0) {
            return false;
        }
        return true;
    }

    function expandNodes(nodes) {
        if (!nodes) return;
        curStatus = "expand";
        var zTree = $.fn.zTree.getZTreeObj("treeHead");
        for (var i = 0, l = nodes.length; i < l; i++) {
            zTree.expandNode(nodes[i], true, false, false);
            if (nodes[i].isParent && nodes[i].zAsync) {
                expandNodes(nodes[i].children);
            } else {
                goAsync = true;
            }
        }
    }

    $("#expandAllBtn").bind("click", expandAll);*/

    $.fn.zTree.init($("#treeHead"), settingHeadKateg); // , zNodes

    /* =========  KRAJ ZTREEHEAD HEAD KATEGORIJE ================ */

});





