<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Notes;
use App\Student;
use App\Task;
use App\Wechat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //后台首页
    public function Home()
    {
        if (is_null(session('adminName'))) {
            return redirect('Login');
        } else {
            return view('admin.Home');
        }
    }

    //修改密码页面
    public function UpdatePassword()
    {
        return view('admin.UpdatePassword');
    }

    public function AddAdmin(Request $request)
    {
        if ($request->isMethod('post')) {
            if (intval(Admin::where('name',session('adminName'))->first()->juri)==1) {
                return redirect()->back()->with('msg', '您不是超级管理员，无权添加');
            }
            $admin['name'] =$request->name;
            $admin['pwd'] =md5($request->pwd);
            $admin['juri'] ="1";
            if (Admin::insert($admin)) {
                return redirect()->back()->with('msg', '添加成功');
            } else {
                return redirect()->back()->with('msg', '添加失败');
            }
        } else {
            return view('admin.Add',[
                'list' => Admin::where('juri',1)->orderBy('id','desc')->get()
                ]);
        }
    }

    //校验修改密码
    public function UpdateAdminPassword(Request $QueryString)
    {
        $name = session('adminName');
        $pwd = md5(trim($QueryString->input('pwd')));
        $admin = Admin::where('name', $name)->update(['pwd' => $pwd]);
        if ($admin > 0) {
            return 'ok';
        } else {
            return '修改失败';
        }
    }

    // 登录页面
    public function Login()
    {
        return view('admin.Login');
    }

    //检查用户名
    public function CheckLogin(Request $QueryString)
    {
        $name = trim($QueryString->input('name'));
        $pwd = md5(trim($QueryString->input('pwd')));
        $admin = Admin::whereRaw('name=? and pwd=?', [$name, $pwd])->first();
        if (is_null($admin)) {
            return '用户名或密码错误';
        } else {
            session(['adminName' => $name]);
            return 'ok';
        }
    }

    //查看所有学生
    public function GetAllStudents()
    {
        $students = Student::all();
        return view('admin.GetAllStudents', ['students' => $students]);
    }

    public function ActivityRecord()
    {
        $arrs = DB::select('SELECT t_student.student_id AS sid,t_student.name AS sname,t_task.name,t_notes.* FROM t_notes,t_student,t_task WHERE t_student.student_id=t_notes.student_id AND t_task.id = t_notes.task_id ORDER BY t_notes.status DESC ');
        $array = json_decode(json_encode($arrs), TRUE);
        $stasks = Task::orderBy('id', 'desc')->get();;
        return View('admin.ActivityRecord', ['arrs' => $array, 'stasks' => $stasks]);
    }

    //签到
    public function Reg()
    {
        $arr = Task::orderBy('id', 'desc')->first();
        return View('admin.Reg', [
            'reg' => $arr
        ]);
    }

    //帅选任务
    public function getTasks(Request $r)
    {
        $sql = 'SELECT t_student.student_id AS sid,t_student.name AS sname,t_task.name,t_notes.* FROM t_notes,t_student,t_task WHERE t_student.student_id=t_notes.student_id AND t_task.id = t_notes.task_id';
        if ($r->input('id') != 0) {
            $sql .= ' AND t_task.id=' . $r->input("id") . ' ';
        }
        $sql .= '  ORDER BY t_notes.status DESC ';
        $arrs = DB::select($sql);
        return json_decode(json_encode($arrs), TRUE);
    }

//    查询学生信息
    public function StudentInfo($id)
    {
        $student = Student::where('id', $id)->first()->toArray();
        return view('admin.StudentInfo', ['student' => $student, 'id' => $id]);
    }

//    修改信息
    public function EditStudentInfo(Request $request)
    {
        $num = $request->input('num');
        $name = $request->input('name');
        $id = $request->input('id');
        $student = Student::where('id', $id)->update([
            'student_id' => $num,
            'name' => $name
        ]);
        if ($student) {
            return 'ok';
        } else {
            return 'Error';
        }
    }

    // 发布任务视图
    public function releaseTask()
    {
        return view('admin.releaseTask');
    }

    /**
     * 把任务写入数据库
     * @param Request $request
     * @return string
     */
    public function createTask(Request $request)
    {
        $task = $request->except('_token');

        // 生成二维码
        $ticket = Wechat::qrcode();

        $task['ticket'] = $ticket;
        // 写入数据库
        $res = Task::create($task);

        if (!$res) {
            return view('admin.error', ['msg' => "发布任务出错"]);
        } else {
            return view('admin.success');
            // 报名页面
           $url = url('admin/signUp') . "?task_id=" . $res->id;
            //发布成功 推送给所有人一个消息
            $result = Wechat::sendMessage($task['name'],$task['start_time'],$task['brief'], $url);
           if ($result){
               return view('admin.success');
           }else{
               echo '<div style="margin: 30px auto;text-align: center;width: 100px;font-size: 30px;color: red;">操作失败</div>';
           }
        }

    }


    /**
     * 学生点击去报名
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     */
    public function signUp(Request $request)
    {
        $user = session('wechat.oauth_user'); // 拿到授权用户资料

        if (!$user) {
            return view('admin.error', ['msg' => '服务器异常']);
        }

        // 查找学生的学号  如果没有 跳去绑定页面
        $openid = $user->id;
        $student = Student::where('openid', $openid)->first();

        // 还没有绑定信息
        if ($student == null) {
            return redirect('bindinfo');
        }


        /**
         * 没有这个额任务
         */
        if (!$request->has('task_id')) {

            return view('admin.error', ['msg' => '任务出错']);
        }


        // 获取任务 id
        $task_id = $request->input('task_id');


        // 写入数据库
        $notes = Notes::where('student_id', $student->student_id)->where('task_id', $task_id)->first();

        // 还没有报名
        if ($notes == null) {
            $notes = [
                'student_id' => $student['student_id'],
                'task_id' => $task_id
            ];

            // 正常报名
            $res = Notes::create($notes);
        } else {

            return view('admin.error', ['msg' => '你已经报名了']);
        }


        if (!$res) {

            return view('admin.error', ['msg' => '报名失败']);
        }

        return view('admin.success');
    }

    /**
     * 查看所有报名人数
     * @param $id   任务的 id
     */
    public function sign($id)
    {
        $notes = DB::table('t_notes')->where('t_task.id', $id)
            ->where('t_notes.status', 0)
            ->join('t_student', 't_notes.student_id', '=', 't_student.student_id')
            ->join('t_task', 't_notes.task_id', '=', 't_task.id')
            ->select('t_student.student_id', 't_student.name', 't_student.work_hour')
            ->get();

        return view('admin.sign', ['notes' => $notes]);
        // $notes = Notes::find($id)->student;
    }


    /**
     * 签到人数
     * @param $id
     */
    public function register($id)
    {
        $notes = DB::table('t_notes')->where('t_task.id', $id)
            ->where('t_notes.status', '>', 0)
            ->join('t_student', 't_notes.student_id', '=', 't_student.student_id')
            ->join('t_task', 't_notes.task_id', '=', 't_task.id')
            ->select('t_student.student_id', 't_student.name', 't_student.work_hour')
            ->get();

        return view('admin.register', ['notes' => $notes]);
        // $notes = Notes::find($id)->student;
    }

    /**
     * 查看所有二维码
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function seeQrCode()
    {
        // 获取所有任务
        $tasks = Task::orderBy('id', 'desc')->get();


        return view('admin.seeAllTasks', ['tasks' => $tasks]);
    }

    public function success()
    {
        return view('admin.success');
    }
}
