"use strict";

$(document).ready(function () {

    /* =========  POCETAK ZTREE ================ */

    var setting = {

        check: {
            enable: true,
            chkStyle: "checkbox", // radio
            chkboxType: {"Y": "", "N": ""}
            //radioType: "all"
        },
        async: {
            enable: true,
            url: "/akcija.php?action=getNodes",
            autoParam: ["id", "name", "level=lv", "parentId"],
            otherParam: {"kategUcitavanje": ''},  // 170,168,171 ovde definisemo ID od kategorija koje zelimo da prikazemo
            dataFilter: filter
        },
        view: {
            addHoverDom: addHoverDom,
            addDiyDom: addDiyDom,
            removeHoverDom: removeHoverDom,
            //dblClickExpand: false, default je true
            selectedMulti: true
            // ovo znaci da mozemo da selektujemo vise nodova odjedamput - to nije checked node
        },
        edit: {
            enable: true,
            editNameSelectAll: true,
            showRemoveBtn: showRemoveBtn,
            showRenameBtn: showRenameBtn
        },

        callback: {
            beforeDrag: beforeDrag,
            beforeDrop: beforeDrop,
            onRename: onRename,
            beforeRemove: beforeRemove,
            onRemove: onRemove,
            onCheck: myOnCheck
            /*
             beforeEditName: beforeEditName,
             beforeRename: beforeRename // kada ovo ukljcimo onda ne radi onRename: onRename
             */
        }
    };

    function myOnCheck(event, treeId, treeNode) {


        var idartiklakoji = treeNode.id;
        var event =  treeNode.checked;

        var url = "/akcija.php?action=activeKateg"; // the script where you handle the form input.
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",  // sada je OK
            data: {
                id: idartiklakoji,
                string: event
            },
            success: function (response) {

                if (response.ok) {
                    alert(response.ok);
                } else {
                    alert(response.error);
                }

            }
        });

    };
    // ovaj filter nam treba da bi prikazali kada se klikne na + podkategorije
    function filter(treeId, parentNode, childNodes) {
        //alert(treeId.value+' '+parentNode.value+' '+childNodes.value);
        if (!childNodes) return null;
        for (var i = 0, l = childNodes.length; i < l; i++) {
            childNodes[i].name = childNodes[i].name.replace(/\.n/g, '.');
        }
        return childNodes;
    }

    // ovde sam dodao custom ikonicu - zvezda.  Kada se klikne na nju oda se otvareju detalji date kategorije
    function addDiyDom(treeId, treeNode) {
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


    // kada se zavrsi beforeRemove onda ide onRremove
    function onRemove(e, treeId, treeNode) {
        showLog("[ " + getTime() + " onRemove ]&nbsp;&nbsp;&nbsp;&nbsp; " + treeNode.name);
    }

    function beforeRemove(treeId, treeNode) {

        var zTree = $.fn.zTree.getZTreeObj("treeDemo");
        zTree.selectNode(treeNode);

        var r = confirm("Confirm delete node '" + treeNode.name + "'?");
        if (r == false) {
            return false;
        }

        var canDelete;

        var idartikla = treeNode.id;
        var parentId = treeNode.parentId;

        var url = "/akcija.php?action=obrisikateg"; // the script where you handle the form input.
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


    var newCount = 1;

    function addHoverDom(treeId, treeNode) {

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

            var url = "/akcija.php?action=dodajkateg";
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

    function removeHoverDom(treeId, treeNode) {
        $("#addBtn_" + treeNode.tId).unbind().remove();
    };

    function showRemoveBtn(treeId, treeNode) {
        // return !treeNode.isFirstNode;
        return true;
    }

    function showRenameBtn(treeId, treeNode) {
        //return !treeNode.isLastNode;
        return true;
    }

    function beforeDrag(treeId, treeNodes) {
        for (var i = 0, l = treeNodes.length; i < l; i++) {
            if (treeNodes[i].drag === false) {
                return false;
            }
        }
        return true;
    }

    function beforeDrop(treeId, treeNodes, targetNode, moveType) {


        var imenoda = targetNode.name;
        var idartikla = targetNode.id;
        var parentId = targetNode.parentId;
        var mestoId = targetNode.mestolok;
        var parentTid = targetNode.parentTId;


        var imenodakoji = treeNodes[0].name;
        var idartiklakoji = treeNodes[0].id;
        var parentIdkoji = treeNodes[0].parentId;
        var mestoIdkoji = treeNodes[0].mestolok;
        var parentTidkoji = treeNodes[0].parentTId;

        console.log(imenoda + ' - ' + idartikla + ' - ' + parentId + ' - ' + mestoId + ' - ' + parentTid);
        console.log(imenodakoji + ' - ' + idartiklakoji + ' - ' + parentIdkoji + ' - ' + mestoIdkoji + ' - ' + parentTidkoji);


        var url = "/akcija.php?action=promenimesto"; // the script where you handle the form input.
        $.ajax({
            type: "POST",
            url: url,
            //dataType: "json",  // kada stavimo ovo onda nam ne radi jer dobijamo { ok:"Dodata kategorija"}  a bez toga dobijamo { "ok":"Dodata kategorija" }
            data: {
                id: idartikla,
                br: idartiklakoji,
                mesCh: mestoId,
                mesPar: mestoIdkoji,
                parentTid: parentTid,
                parentTidkoji: parentTidkoji,
                moveType: moveType
            },
            success: function (response) {

                var obj = jQuery.parseJSON(response);
                if (obj.ok) {
                    alert(obj.ok);
                } else {
                    alert(obj.error);
                }

            }
        });


        return targetNode ? targetNode.drop !== false : true;
    }


    function onRename(e, treeId, treeNode, isCancel) {

        var imenoda = treeNode.name;
        var idartikla = treeNode.id;
        var parentId = treeNode.parentId;

        var url = "/akcija.php?action=editujkateg"; // the script where you handle the form input.
        $.ajax({
            type: "POST",
            url: url,
            //dataType: "json",  // kada stavimo ovo onda nam ne radi jer dobijamo { ok:"Dodata kategorija"}  a bez toga dobijamo { "ok":"Dodata kategorija" }
            data: {id: idartikla, br: parentId, string: imenoda},
            success: function (response) {

                var obj = jQuery.parseJSON(response);
                if (obj.ok) {
                    alert(obj.ok);
                } else {
                    alert(obj.error);
                }

            }
        });
    }


    $.fn.zTree.init($("#treeDemo"), setting); // , zNodes


    var curStatus = "init", curAsyncCount = 0, asyncForAll = false,
        goAsync = false;

    function expandAllKateg() {

        if (!checkKateg()) {
            return;
        }
        var zTree = $.fn.zTree.getZTreeObj("treeDemo");
        if (asyncForAll) {
            zTree.expandAll(true);
        } else {
            expandNodes(zTree.getNodes());
            if (!goAsync) {
                // $("#demoMsg").text(demoMsg.expandAll);
                curStatus = "";
            }
        }
    }

    function checkKateg() {
        if (curAsyncCount > 0) {
            return false;
        }
        return true;
    }

    function expandNodes(nodes) {
        if (!nodes) return;
        curStatus = "expand";
        var zTree = $.fn.zTree.getZTreeObj("treeDemo");
        for (var i = 0, l = nodes.length; i < l; i++) {
            zTree.expandNode(nodes[i], true, false, false);
            if (nodes[i].isParent && nodes[i].zAsync) {
                expandNodes(nodes[i].children);
            } else {
                goAsync = true;
            }
        }
    }

    $("#expandAllBtnKateg").bind("click", expandAllKateg);


    /* =========  KRAJ ZTREE ================ */

});





