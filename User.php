<?php
include_once 'Database.php';

class User extends Database
{
    private string $name;
    private string $email;
    private string $password;

    /**
     * @param string $name
     * @param string $email
     * @param string $password
     */
    public function __construct(string $name, string $email, string $password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public function setUser()
    {
        $insert_query = "INSERT INTO users (name,email,password,status) VALUES ('" . $this->name . "','" . $this->email . "', '" . md5($this->password) . "',0); ";
        return mysqli_query($this->getConnection(), $insert_query);
    }

    public function getUser()
    {
        $select_query = "SELECT * FROM users WHERE email='" . $this->email . "' AND password='" . md5($this->password) . "'; ";
        return mysqli_query($this->getConnection(), $select_query); 
    }

    public function getStudents()
    {
        $students_select_query = "SELECT users.id AS userid, users.name AS username, users.address AS useraddress, users.status, course.name AS coursename, course.code FROM users LEFT OUTER JOIN course ON users.course_code=course.code WHERE users.role='student';";
        return mysqli_query($this->getConnection(), $students_select_query);
    }

    public function getSignedUser($userid)
    {
        $student_select_query = "SELECT * FROM users WHERE id='" . $userid . "'";
        $student_result = mysqli_query($this->getConnection(), $student_select_query);
        return mysqli_fetch_assoc($student_result);
    }
}
