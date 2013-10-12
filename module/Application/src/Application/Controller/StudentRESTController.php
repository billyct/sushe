<?php

namespace Application\Controller;

use Zend\View\Model\JsonModel;

use User\Lib\Role;

use Application\Entity\Student;

use Application\Exception\BuildException;

use Application\Entity\Room;

use User\Entity\User;


class StudentRESTController extends AbstractUsefulRESTController {
	/*
	 * (non-PHPdoc) @see
	 * \Zend\Mvc\Controller\AbstractRestfulController::create()
	 */
	public function create($data) {
		
		// TODO Auto-generated method stub
		$build_id = $data['build'];
		$roomname = $data['room'];
		$bed_num = $data['bed'];
		$student_num = $data['student_num'];
		$real_name = $data['real_name'];
		$gender = $data['gender'];
		$college = $data['college'];
		$specialty = $data['specialty'];
		$grade = $data['grade'];
		$class = $data['class'];
		$phone = $data['phone'];
		$checkin = $data['checkin'];
		
		//这里的邮箱如何解决？
		$email = $student_num.'@bi.com';
		
		
		$userModel = $this->getServiceLocator()->get('UserModel');
		
		$roleModel = $this->getServiceLocator()->get('RoleModel');
		$role = $roleModel->getRoleById(Role::STUDENT);
		$user = new User();
		$user->setUsername($student_num)
			->setPassword($phone)
			->setDisplayName($real_name)
			->setEmail($email)
			->addRole($role);
		
		$user = $userModel->register($user);
		
		$buildModel = $this->getServiceLocator()->get('BuildModel');
		$build = $buildModel->getById($build_id);
		
		if ($build == null) {
			throw new BuildException('楼号不存在');
		}
		
		$roomModel = $this->getServiceLocator()->get('RoomModel');
		$room = $roomModel->getBy(array('name' => $roomname, 'build' => $build));
		if ($room == null) {
			$room = new Room();
			$room->setName($roomname)
				->setBuild($build);
			
			$room = $roomModel->insert($room);
		}
		
		$studentModel = $this->getServiceLocator()->get('StudentModel');
		$student = new Student();
		$student->setRoom($room)
			->setBed_num($bed_num)
			->setCheckin(new \DateTime($checkin))
			->setClass($class)
			->setCollege($college)
			->setGender($gender)
			->setGrade($grade)
			->setPhone($phone)
			->setReal_name($real_name)
			->setSpecialty($specialty)
			->setStudent_num($student_num)
			->setBuild($build)
			->setUser($user);
		$student = $studentModel->insert($student);
		
		
		return new JsonModel($student);
	}
	
	/*
	 * (non-PHPdoc) @see
	 * \Zend\Mvc\Controller\AbstractRestfulController::delete()
	 */
	public function delete($id) {
		// TODO Auto-generated method stub
	}
	
	/*
	 * (non-PHPdoc) @see \Zend\Mvc\Controller\AbstractRestfulController::get()
	 */
	public function get($id) {
		// TODO Auto-generated method stub
		$studentModel = $this->getServiceLocator()->get('StudentModel');
		$student = $studentModel->getArrayById($id);
		return new JsonModel($student);
	}
	
	/*
	 * (non-PHPdoc) @see
	 * \Zend\Mvc\Controller\AbstractRestfulController::getList()
	 */
	public function getList() {
		// TODO Auto-generated method stub
		
		$studentModel = $this->getServiceLocator()->get('StudentModel');
		$students = $studentModel->getList($this->current_user);
		return new JsonModel($students);
	}
	
	/*
	 * (non-PHPdoc) @see
	 * \Zend\Mvc\Controller\AbstractRestfulController::update()
	 */
	public function update($id, $data) {
		// TODO Auto-generated method stub
		
		$build_id = $data['build'];
		$roomname = $data['room'];
		$bed_num = $data['bed'];
		$student_num = $data['student_num'];
		$real_name = $data['real_name'];
		$gender = $data['gender'];
		$college = $data['college'];
		$specialty = $data['specialty'];
		$grade = $data['grade'];
		$class = $data['class'];
		$phone = $data['phone'];
		$checkin = $data['checkin'];
		
		$buildModel = $this->getServiceLocator()->get('BuildModel');
		$build = $buildModel->getById($build_id);
		
		if ($build == null) {
			throw new BuildException('楼号不存在');
		}
		
		$roomModel = $this->getServiceLocator()->get('RoomModel');
		$room = $roomModel->getBy(array('name' => $roomname, 'build' => $build));
		if ($room == null) {
			$room = new Room();
			$room->setName($roomname)
				->setBuild($build);
			$room = $roomModel->insert($room);
		}
		
		$studentModel = $this->getServiceLocator()->get('StudentModel');
		$student = $studentModel->getById($id);
		
		$student->setRoom($room)
			->setBed_num($bed_num)
			->setCheckin(new \DateTime($checkin))
			->setClass($class)
			->setCollege($college)
			->setGender($gender)
			->setGrade($grade)
			->setPhone($phone)
			->setReal_name($real_name)
			->setSpecialty($specialty)
			->setStudent_num($student_num)
			->setBuild($build);
		$student = $studentModel->update($student);
		
		
		return new JsonModel($student);
	}
}

?>