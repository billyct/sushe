(function ($) {

var StudentInfo = Backbone.Model.extend({
	url: site.baseUrl+'/student/getInfo'
});

var ElectricBill = Backbone.Model.extend({
	url: site.baseUrl+'/electric/getElectricBill'
});

var StudentHealths = Backbone.Collection.extend({
	url : site.baseUrl+'/health/getHealths'
});

var Repair = Backbone.Model.extend({
	urlRoot : site.baseUrl+'/repairs-rest'
});

var studentInfo = new StudentInfo;
studentInfo.fetch({
	success: function(student) {
		studentInfo = student;
	}
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

var StudentInfoView = Backbone.View.extend({
	el:'#page',
	template: _.template($('#student-info-template').html()),
	render: function(options) {
		var self = this;
		$('#loading-block').show();

		$('#loading-block').fadeOut(function() {
			self.$el.html(self.template({student: studentInfo}));
		});
			
		
	}
});

var studentinfoView = new StudentInfoView;

var StudentElectricView = Backbone.View.extend({
	el:'#page',
	template: _.template($('#student-electric-template').html()),
	events:{
		'click #pay-electric': 'pay'
	},
	render: function(options) {
		var self = this;
		var electricbill = new ElectricBill;

		$('#loading-block').show();
		electricbill.fetch({
			success: function(electricbill) {
				if (electricbill.has('id')) {
					$('#loading-block').fadeOut(function() {
						self.$el.html(self.template({electric: electricbill}));
					});
				}else {
					$('#loading-block').fadeOut(function() {
						self.$el.html(self.template({electric: null}));
					});
				}
			}
		});
		
	},
	pay: function(e) {
		var electric_id = $(e.currentTarget).attr('data-electric-id');
		$.post(site.baseUrl+'/electric/pay', {
			electric_id : electric_id
		}, function(data){
			alert(data.msg);
			windows.location.refresh();
		},'json');
		return false;
	}
});

var studentelectricView = new StudentElectricView;


var StudentHealthView = Backbone.View.extend({
	el:'#page',
	template: _.template($('#student-health-template').html()),
	render: function(options) {
		var self = this;
		var healths = new StudentHealths;

		$('#loading-block').show();
		
		healths.fetch({
			success: function(healths) {
				$('#loading-block').fadeOut(function() {
					self.$el.html(self.template({healths: healths.models, student: studentInfo}));
				});
			}
		});
		
	}
});

var studenthealthView = new StudentHealthView;


var StudentRepairView = Backbone.View.extend({
	el:'#page',
	template: _.template($('#student-repair-template').html()),
	events: {
        'submit #repair-form': 'saveRepair'
    },
	render: function(options) {
		var self = this;
		$('#loading-block').show();
		$('#loading-block').fadeOut(function() {
			self.$el.html(self.template);
			$("#time_rest").datetimepicker();
		});
	},
	saveRepair: function(e) {
		$('#loading-block').show();

    	var repairDetail = $(e.currentTarget).serializeObject();
    	var repair = new Repair;
    	repair.save(repairDetail, {
    		success: function(data) {
    			$('#loading-block').fadeOut(function() {
    				student_router.navigate('', {trigger:true});
    			});
    		}
    	});

    	return false;
	}
});

var studentrepairView = new StudentRepairView;


var StudentRouter = Backbone.Router.extend({
	routes: {
		'':'home',
	    'student/info' : 'info',
	    'student/electric'  : 'electric',
	    'student/health'  : 'health',
	    'student/repair'  : 'repair'
	},
	home: function() {
		homeView.render();
	},
	info: function() {
		studentinfoView.render();
	},
	electric: function() {
		studentelectricView.render();
	},
	health: function() {
		studenthealthView.render();
	},
	repair: function() {
		studentrepairView.render();
	}
});
var student_router = new StudentRouter;



})($);