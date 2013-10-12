(function ($) {

var RepairList = Backbone.Collection.extend({
	url : site.baseUrl+'/repairs-rest'
});

var Repair = Backbone.Model.extend({
	urlRoot : site.baseUrl+'/repairs-rest'
});

var HomeView = Backbone.View.extend({
	el: '#page',
	template: _.template($('#home-template').html()),
	render: function(options) {
		var self = this;
		$('#loading-block').show();
		$('#loading-block').fadeOut(function() {
			self.$el.html(self.template);
		});
	}
});
var homeView = new HomeView;

var RepairListView = Backbone.View.extend({
	el:'#page',
	template: _.template($('#repair-list-template').html()),
	render: function(options) {
		var self = this;
		$('#loading-block').show();
		var repairs = new RepairList;
		repairs.fetch({
			success: function(repairs) {
				$('#loading-block').fadeOut(function() {
					self.$el.html(self.template({repairs: repairs.models}));
				});
			}
		});
		
	}
});

var repairlistView = new RepairListView;


var FeedbackView = Backbone.View.extend({
	el:'#page',
	template: _.template($('#repair-feedback-template').html()),

	events: {
		'submit #feedback-form': 'feedback',
		'click #file-repair': 'file'
	},
	
	render: function(options) {
		var self = this;
		var repair = new Repair({id: options.id});
		$('#loading-block').show();
		repair.fetch({
			success: function(repair) {
				$('#loading-block').fadeOut(function() {
					self.$el.html(self.template({repair: repair}));
					$("#time_rest").datetimepicker();
				});
			}
		});
		
	},
	feedback: function(e) {
		var repairDetail = $(e.currentTarget).serializeObject();

		var repair = new Repair;
    	repair.save(repairDetail, {
    		success: function(data) {
    			engine_router.navigate('repair/list', {trigger:true});
    		}
    	});

    	return false;
	},
	file: function(e) {
		
		var repairDetail = {
			feedback: $('#feedback').val(),
			status: 2,
			id: $('#id').val()
		};


		var repair = new Repair;
    	repair.save(repairDetail, {
    		success: function(data) {
    			engine_router.navigate('repair/list', {trigger:true});
    		}
    	});

    	return false;
	}
});

var feedbackView = new FeedbackView;


var EngineRouter = Backbone.Router.extend({
	routes: {
		'':'home',
	    'repair/list' : 'list_repair',
	    'repair/feedback/:id'  : 'feedback'
	},
	home: function() {
		homeView.render();
	},
	list_repair: function() {
		repairlistView.render();
	},
	feedback: function(id) {
		feedbackView.render({id: id});
	}
});
var engine_router = new EngineRouter;



})($);
