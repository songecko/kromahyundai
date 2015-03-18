var editor = function($)
{
	var sending = false;
	var sendUrl = $('#resourcesTree').data('editorUrl');
	
	var _send = function(sendData, successCallback) 
	{
		if(!sending)
		{
			$('.loading i').show();
			sending = true;
			
			$.ajax({
				type: "POST", url: sendUrl, data: sendData,	cache: false,
				error: function(jqXHR, textStatus, errorThrown)
				{
		        	alert('Se produjo un error, vuelva a intentarlo.');
		        	console.log(errorThrown);
				},
				complete: function()
				{
					sending = false;
					$('.loading i').hide();
				},
				success: function(data)
				{
					if(data.error == false)
					{
						successCallback(data);
					}
				}
			});
		}
	};
	
	var _createNode = function(parentNode, successCallback)
	{
		_send({'action': 'create', 'id': parentNode.data.id}, successCallback)
	}
	
	var _deleteNode = function(node, successCallback)
	{
		_send({'action': 'delete', 'id': node.data.id}, successCallback)
	}
	
	var _renameNode = function(node, successCallback)
	{
		_send({'action': 'rename', 'id': node.data.id, 'text': node.text}, successCallback)
	}
	
	return {
		createNode: _createNode,
		deleteNode: _deleteNode,
		renameNode: _renameNode
	}
}(jQuery);


(function ($, editor) 
{
    'use strict';

    $(document).ready(function() 
    {
    	var userType = $('#resourcesTree').data('userType');
    	
    	$('#resourcesTree')
    		.on('create_node.jstree', function(e, data)
    		{
    			/*console.log(e);
    			console.log(data);*/
    		})
    		.on('rename_node.jstree', function(e, data)
    		{
    			console.log(data);
    			editor.renameNode(data.node, function(){});
    		})
    		.on('delete_node.jstree', function(e, data)
    		{    			
    			editor.deleteNode(data.node, function(){});
    		})
    		.jstree({
    			"core" : {
    				"check_callback" : true
    			},
    			"contextmenu": {
    				"items": function($node)
    				{
    					var tree = $("#resourcesTree").jstree(true);
    					var actions = {
    					};
    					
    					if($node.data.type != undefined && $node.data.type == 'folder' && userType == 'admin')
    					{    			
    						var actions = $.extend(actions, {
    							"Upload": {
	    			                "separator_before": false,
	    			                "separator_after": false,
	    			                "label": "Upload files",
	    			                "icon": "fa fa-upload",
	    			                "action": function (obj) 
	    			                { 	
	    			                	window.open("/resources/"+$node.data.id+"/files");
	    			                }
	    			            },
	    			            "Download all": {
	    			                "separator_before": false,
	    			                "separator_after": true,
	    			                "label": "Download all",
	    			                "icon": "fa fa-download",
	    			                "action": function (obj) 
	    			                {
	    			                	window.open("/resources/"+$node.data.id+"/download-all");
	    			                }
	    			            }
    						});
    					}
    					
    					if($node.data.type != undefined && $node.data.type == 'file')
    					{
    						var actions = $.extend(actions, {
    							"Download": {
	    			                "separator_before": false,
	    			                "separator_after": true,
	    			                "label": "Download file",
	    			                "icon": "fa fa-download",
	    			                "action": function (obj) 
	    			                {
	    			                	window.open("/resources/"+$node.data.id+"/download");
	    			                }
	    			            },
	    			            "Preview": {
	    			                "separator_before": false,
	    			                "separator_after": true,
	    			                "label": "Preview",
	    			                "icon": "fa fa-eye",
	    			                "action": function (obj) 
	    			                {
	    			                	$('#previewModal .modal-body').html('<img src="/file/'+$node.data.id+'/preview" class="img-responsive">');
	    			                	$('#previewModal').modal('show');
	    			                }
	    			            }
    						});
    					}
    					
    					if($node.data.type != undefined && ($node.data.type == 'folder' || $node.data.type == 'root')  && userType == 'admin')
    					{    			
    						var actions = $.extend(actions, {
		    					"Create": {
					                "separator_before": true,
					                "separator_after": false,
					                "label": "Create",
					                "icon": "fa fa-plus",
					                "action": function (obj) 
					                { 
					                	editor.createNode($node, function(data)
					                	{
					                		var newNode = tree.create_node($node);
					                		tree.get_node(newNode).data = {'id': data.resource_id, 'type': 'folder'};
		    			                    tree.edit(newNode);
					                	});	    			                    
					                }
					            }
    						});
    					}
    					
    					if($node.data.type != undefined && ($node.data.type == 'folder'/* || $node.data.type == 'file'*/)  && userType == 'admin')
    					{    						
							var actions = $.extend(actions, {
	    			            "Rename": {
	    			                "separator_before": false,
	    			                "separator_after": false,
	    			                "label": "Rename",
	    			                "icon": "fa fa-pencil",
	    			                "action": function (obj) 
	    			                { 
	    			                    tree.edit($node);
	    			                }
	    			            },                         
	    			            "Remove": {
	    			                "separator_before": true,
	    			                "separator_after": false,
	    			                "label": "Remove",
	    			                "icon": "fa fa-times",
	    			                "action": function (obj) 
	    			                { 
	    			                    if(confirm("Are you sure?"))
	    			                    {
	    			                    	tree.delete_node($node);	    			                    
	    			                    }
	    			                }
	    			            }
	    			        });
    					}   					
    					
    					return actions;
    				}
    			},
    			"plugins" : [
    			    "contextmenu"
    			]
    		});
    });
})(jQuery, editor);