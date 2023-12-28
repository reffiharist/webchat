"use strict";

var tableData;
var save_method;

function tableData() {
	tableData = $('#dataTable').DataTable( {
		"processing" : true,
		"lengthChange": false,
		"info": false,
		"serverSide": true,
		"stateSave" : false,
		responsive: false,
		order: [],
        "ajax":{
            url : baseUrl + "/backend/order/dataList",
            type: "post",
        },
		columnDefs: [
			{targets: [0], class: 'text-gray-800 fw-bold'},
            {targets: [2], class: 'text-end pe-0'},
            {targets: [3], class: 'text-end pe-0'},
            {targets: [4], class: 'text-end pe-0'},
			{targets: [5], orderable: false, class: 'text-end pe-0'},
		],
		
	});
};

KTUtil.onDOMContentLoaded(function () {
    tableData();

    // Add function KTMenu
    tableData.on('draw', function() {
        KTMenu.createInstances();
    });

    // Search table
    document.querySelector('[data-kt-filter="search"]').addEventListener("keyup", function (t) {
        tableData.search(t.target.value).draw();
    });
});
