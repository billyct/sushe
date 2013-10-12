(function ($) {

var BuildManagedList = Backbone.Collection.extend({
	url : site.baseUrl+'/build/getManagedList'
});

var StudentList = Backbone.Collection.extend({
	url : site.baseUrl+'/students-rest'
});

var Student = Backbone.Model.extend({
	urlRoot : site.baseUrl+'/students-rest'
});

var ElectricList = Backbone.Collection.extend({
	url: site.baseUrl+'/electrics-rest'
});
var Electric = Backbone.Model.extend({
	urlRoot : site.baseUrl+'/electrics-rest'
});

var HealthList = Backbone.Collection.extend({
	url: site.baseUrl+'/healths-rest'
});

var Health = Backbone.Model.extend({
	urlRoot : site.baseUrl+'/healths-rest'
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



var StudentView = Backbone.View.extend({
	el: '#page',
	template: _.template($('#student-form-template').html()),
	events: {
        'submit #student-form': 'saveStudent'
    },
	builds: new BuildManagedList,
	render: function(options) {
		var self = this;
		if (options.id) {
			var student = new Student({id: options.id});
			student.fetch({
				success: function(student) {
					$('#loading-block').fadeOut(function() {
						self.$el.html(self.template({builds: self.builds.models, student: student}));
						$("#checkin").datetimepicker({
					      pickTime: false
					    });
					});
				}
			});
		} else {
			$('#loading-block').fadeOut(function() {
				self.$el.html(self.template({builds: self.builds.models, student: null}));
				$("#checkin").datetimepicker({
			      pickTime: false
			    });
			});
		}
		
	},
	ready: function(options) {
		$('#loading-block').show();
		var self = this;
		self.builds.fetch({
			success: function() {
				self.render(options);
			}
		});
	},
	saveStudent: function(e) {

		$('#loading-block').show();
    	var studentDetail = $(e.currentTarget).serializeObject();
    	var student = new Student;
    	student.save(studentDetail, {
    		success: function(data) {
    			depart_router.navigate('student/list', {trigger:true});
    		}
    	});

    	return false;
	}
});

var studentView = new StudentView;

var StudentListView = Backbone.View.extend({
	el : '#page',
	template: _.template($('#student-list-template').html()),
	render: function(options) {
		
		var self = this;
		var students = new StudentList;
		students.fetch({
			success: function(students) {
				blockloading(function(){
					self.$el.html(self.template({students: students.models}));
				});
			}
		});
	}
});
var studentlistView = new StudentListView;

var ElectricView = Backbone.View.extend({
	el:'#page',
	template: _.template($('#electric-form-template').html()),
	events: {
        'submit #electric-form': 'saveElectric'
    },
	render: function(options) {
		var self = this;
		$('#loading-block').show();
		if (options.id) {
			var electric = new Electric({id: options.id});
			electric.fetch({
				success: function(electric) {
					$('#loading-block').fadeOut(function() {
						self.$el.html(self.template({electric: electric}));

						$("#dead_line").datetimepicker({
					      pickTime: false
					    });
					    $("#create_at").datetimepicker({
					      pickTime: false
					    });
					});
				}
			});
		}else {
			$('#loading-block').fadeOut(function() {
				self.$el.html(self.template({electric: null}));

				$("#dead_line").datetimepicker({
			      pickTime: false
			    });
			    $("#create_at").datetimepicker({
			      pickTime: false
			    });
			});
		}
		
		
	},
	saveElectric: function(e) {
		$('#loading-block').show();
    	var electricDetail = $(e.currentTarget).serializeObject();
    	var electric = new Electric;
    	electric.save(electricDetail, {
    		success: function(data) {
    			depart_router.navigate('electric/list', {trigger:true});
    		}
    	});

    	return false;
	}
});

var electricView = new ElectricView;

var ElectricListView = Backbone.View.extend({
	el : '#page',
	template: _.template($('#electric-list-template').html()),
	render: function(options) {
		var self = this;
		var electrics = new ElectricList;
		$('#loading-block').show();
		electrics.fetch({
			success: function(electrics) {
				$('#loading-block').fadeOut(function() {
					self.$el.html(self.template({electrics : electrics.models}));
				});
			}
		});
		
	}
});

var electriclistView = new ElectricListView;

var HealthView = Backbone.View.extend({
	el:'#page',
	template: _.template($('#health-form-template').html()),
	events: {
        'submit #health-form': 'saveHealth'
    },
	render: function(options) {
		var self = this;
		$('#loading-block').show();
		if (options.id) {
			var health = new Health({id: options.id});
			health.fetch({
				success: function(health) {
					$('#loading-block').fadeOut(function() {
						
						self.$el.html(self.template({health: health}));

						$("#create_at").datetimepicker({
					      pickTime: false
					    });
					});
				}
			})
		} else {
			$('#loading-block').fadeOut(function() {
				self.$el.html(self.template({health: null}));
				$("#create_at").datetimepicker({
			      pickTime: false
			    });
			});
		}
		
		
	},
	saveHealth: function(e) {
		$('#loading-block').show();
    	var healthDetail = $(e.currentTarget).serializeObject();

    	var health = new Health;
    	health.save(healthDetail, {
    		success: function(data) {
    			depart_router.navigate('health/list', {trigger:true});
    		}
    	});

    	return false;
	}
});

var healthView = new HealthView;

var HealthListView = Backbone.View.extend({
	el : '#page',
	template: _.template($('#health-list-template').html()),
	render: function(options) {
		var self = this;
		var healths = new HealthList;
		$('#loading-block').show();
		healths.fetch({
			success: function(healths) {
				$('#loading-block').fadeOut(function() {
					self.$el.html(self.template({healths: healths.models}));
				});
			}
		});
		
	}
});

var healthlistView = new HealthListView;

var DepartRouter = Backbone.Router.extend({
	routes: {
		'':'home',
	    'student/list' : 'list_student',
	    'student/add'  : 'form_student',
	    'student/edit/:id'  : 'form_student',
	    'electric/list' : 'list_electric',
	    'electric/add' : 'form_electric',
	    'electric/edit/:id' : 'form_electric',
	    'health/list' : 'list_health',
	    'health/add' : 'form_health',
	    'health/edit/:id' : 'form_health'
	},
	home: function() {
		homeView.render();
	},
	list_student: function() {
		studentlistView.render();
	},
	form_student: function(id) {
		studentView.ready({id: id});
	},
	list_electric: function() {
		electriclistView.render();
	},
	form_electric: function(id) {
		electricView.render({id: id});
	},
	list_health: function() {
		healthlistView.render();
	},
	form_health: function(id) {
		healthView.render({id:id});
	}
});
var depart_router = new DepartRouter;



})($);