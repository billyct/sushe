(function ($) {




var ParkList = Backbone.Collection.extend({
	url: site.baseUrl+'/parks-rest'
});

var Park = Backbone.Model.extend({
	urlRoot: site.baseUrl+'/parks-rest'
});

var BuildList = Backbone.Collection.extend({
	url: site.baseUrl+'/builds-rest'
});

var Build = Backbone.Model.extend({
	urlRoot: site.baseUrl+'/builds-rest'
});

var UserList = Backbone.Collection.extend({
	url: site.baseUrl+'/users-rest'
});
var User = Backbone.Model.extend({
	urlRoot: site.baseUrl+'/users-rest'
});

var UserDepartList = Backbone.Collection.extend({
	url: site.baseUrl+'/build/admins'
});

var RoleList = Backbone.Collection.extend({
	url : site.baseUrl+'/roles-rest'
});

// var ParkList = Backbone.Collection.extend({
// 	model: ParkModel

// });
// var parks = new ParkList;

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


var ParkView = Backbone.View.extend({
	el: '#page',
	events: {
        'submit #park-form': 'savePark',
        'click #delete': 'deletePark'
    },
    savePark: function(e) {
    	$('#loading-block').show();
    	var parkDetail = $(e.currentTarget).serializeObject();
    	var park = new Park;
    	park.save(parkDetail, {
    		success: function(data) {
    			super_router.navigate('depart/park/list', {trigger:true});
    		}
    	});

    	return false;
    },
    deletePark: function(e) {

    },
	template: _.template($('#park-form-template').html()),
	render: function(options) {
		$('#loading-block').show();
		var self = this;
		if (options.id) {
			var park = new Park({id : options.id});
			park.fetch({
				success: function(park) {
					$('#loading-block').fadeOut(function() {
						self.$el.html(self.template({park:park}));
					});
					
				}
			});
		} else {
			$('#loading-block').fadeOut(function() {
				self.$el.html(self.template({park:null}));
			});
		}
		
	}
});
var parkView = new ParkView;

var ParkListView = Backbone.View.extend({
	el: '#page',
	template: _.template($('#park-list-template').html()),

	render: function(options) {
		$('#loading-block').show();
		var self = this;
		var parks = new ParkList;
		parks.fetch({
          success: function (parks) {
          	$('#loading-block').fadeOut(function(){ 
				self.$el.html(self.template({parks: parks.models}));
          	});
            
          }
        });
	}
});
var parklistView = new ParkListView;

var BuildView = Backbone.View.extend({
	el: '#page',
	events: {
		'submit #build-form': 'saveBuild',
	},
	parks: new ParkList,
	admins: new UserDepartList,
	template: _.template($('#build-form-template').html()),
	initialize: function() {
		//this.listenTo(this.parks, 'all', this.render);
	},
	render: function(options) {
		$('#loading-block').show();
		var self = this;
		if (options.id) {
			var build = new Build({id: options.id});
			build.fetch({
				success: function(build) {
					$('#loading-block').fadeOut(function(){ 
						self.$el.html(self.template({parks: self.parks.models,users: self.admins.models, build: build}));
					});
				}
			});
			
		}else {
			$('#loading-block').fadeOut(function(){ 
				self.$el.html(self.template({parks: self.parks.models, users: self.admins.models, build: null}));
			});
		}
		
		
	},
	ready: function(options) {
		$('#loading-block').show();
		var self = this;
		self.parks.fetch({
			success: function(parks) {
				self.admins.fetch({
					success: function() {
						$('#loading-block').fadeOut(function(){
							self.render(options);
						});
					}
				});	
			}
		});
	},
	saveBuild: function(e){
		var buildDetail = $(e.currentTarget).serializeObject();

    	var build = new Build;
    	build.save(buildDetail, {
    		success: function(data) {
    			super_router.navigate('depart/build/list', {trigger:true});
    		}
    	});

    	return false;
	}
});
var buildView = new BuildView;

var BuildListView = Backbone.View.extend({
	el : '#page',
	template: _.template($('#build-list-template').html()),
	render: function(options) {
		$('#loading-block').show();
		var self = this;
		var builds = new BuildList;
		builds.fetch({
			success: function(builds) {
				$('#loading-block').fadeOut(function(){ 
					self.$el.html(self.template({builds: builds.models}));	
				});
			}
		});
		
	}
});
var buildlistView = new BuildListView;

var UserView = Backbone.View.extend({
	el : '#page',
	template: _.template($('#user-form-template').html()),
	roles: new RoleList,
	events: {
		'submit #user-form': 'saveUser',
	},
	render: function(options) {
		$('#loading-block').show();
		var self = this;
		if (options.id) {
			var user = new User({id: options.id});
			user.fetch({
				success: function(user) {
					$('#loading-block').fadeOut(function(){ 
						self.$el.html(self.template({roles: self.roles.models, user: user}));
						$(".chzn-select").chosen({
					      width: '95%'
					    });
					});
				}
			});
		} else {
			$('#loading-block').fadeOut(function(){ 
				self.$el.html(self.template({roles: self.roles.models, user:null}));
				$(".chzn-select").chosen({
			      width: '95%'
			    });
			});
		}
		
		
	},
	ready: function(options) {
		$('#loading-block').show();
		var self = this;
		this.roles.fetch({
			success: function(roles) {
				$('#loading-block').fadeOut(function(){ 
					self.render(options);
				});
			}
		});

	},
	saveUser: function(e) {
		var userDetail = $(e.currentTarget).serializeObject();
		var user = new User;
		user.save(userDetail, {
			success: function(data) {
				super_router.navigate('user/list', {trigger:true});
			}
		});
		return false;
	}
});

var userView = new UserView;

var UserListView = Backbone.View.extend({
	el : '#page',
	template: _.template($('#user-list-template').html()),
	render: function(options) {
		$('#loading-block').show();
		var self = this;
		//self.$el.html(self.template);
		var users = new UserList;
		users.fetch({
			success: function(users) {
				$('#loading-block').fadeOut(function(){ 
					self.$el.html(self.template({users: users.models}));
				});
			}
		});
	}
});
var userlistView = new UserListView;



var SuperRouter = Backbone.Router.extend({
	routes: {
		'':'home',
	    'depart/park/list':       'list_park',
	    'depart/park/add':        'form_park',
	    'depart/park/edit/:id':   'form_park', 
	    'depart/build/list':      'list_build',
	    'depart/build/add':       'form_build',
	    'depart/build/edit/:id':  'form_build',
	    'user/list': 			  'list_user',
	    'user/add':               'form_user',
	    'user/edit/:id':          'form_user',
	    'user/authorize':         'authorize_user' //授权宿舍管理员用户
	},
	home: function() {
		homeView.render();
	},
	list_park: function(){
		parklistView.render();
	},
	form_park: function(id){
		parkView.render({id: id});
	},
	list_build: function(){
		buildlistView.render();
	},
	form_build: function(id){
		buildView.ready({id:id});
	},
	list_user: function() {
		userlistView.render();
	},
	form_user: function(id) {
		userView.ready({id:id});
	}
});
var super_router = new SuperRouter;

// Backbone.history.start();
})($);