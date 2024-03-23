<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Str;

class AdminController extends Controller
{
  public function UserManagement()
  {
    $users = User::whereDoesntHave('roles', function ($query) {
      $query->whereIn('name', ['user', 'administrator']);
    })->get();
    $roles = Role::whereNotIn('name', ['administrator'])->get();
    $userCount = $users->count();
    $verified = User::whereDoesntHave('roles', function ($query) {
      $query->whereIn('name', ['user', 'administrator']);
    })->whereNotNull('email_verified_at')->get()->count();
    $notVerified = User::whereDoesntHave('roles', function ($query) {
      $query->whereIn('name', ['user', 'administrator']);
    })->whereNull('email_verified_at')->get()->count();
    $usersUnique = $users->unique(['email']);
    $userDuplicates = $users->diff($usersUnique)->count();

    return view('content.admin.index', [
      'roles' => $roles,
      'totalUser' => $userCount,
      'verified' => $verified,
      'notVerified' => $notVerified,
      'userDuplicates' => $userDuplicates,
    ]);
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
      $columns = [
          1 => 'id',
          2 => 'name',
          3 => 'email',
          4 => 'email_verified_at',
      ];

      $search = [];

      $totalData = User::whereHas('roles', function ($query) {
        $query->where('name', '!=', 'Administrator');
    })->count();

      $totalFiltered = $totalData;

      $limit = $request->input('length');
      $start = $request->input('start');
      $order = $columns[$request->input('order.0.column')];
      $dir = $request->input('order.0.dir');

      $administratorRoleId = Role::where('name', 'administrator')->value('id');

      if (empty($request->input('search.value'))) {
          $users = User::with('roles')
              ->whereDoesntHave('roles', function ($query) use ($administratorRoleId) {
                  $query->where('id', $administratorRoleId);
              })
              ->offset($start)
              ->limit($limit)
              ->orderBy($order, $dir)
              ->get();
      } else {
        $search = $request->input('search.value');

        $users = User::with('roles')
            ->whereDoesntHave('roles', function ($query) use ($administratorRoleId) {
                $query->where('id', $administratorRoleId);
            })
            ->where(function ($query) use ($search) {
                $query->where('id', 'LIKE', "%{$search}%")
                      ->orWhere('name', 'LIKE', "%{$search}%")
                      ->orWhere('email', 'LIKE', "%{$search}%")
                      // Add searching by role name
                      ->orWhereHas('roles', function ($query) use ($search) {
                          $query->where('name', 'LIKE', "%{$search}%");
                      });
            })
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();

        $totalFiltered = User::where(function ($query) use ($search) {
            $query->where('id', 'LIKE', "%{$search}%")
                  ->orWhere('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  // Add searching by role name
                  ->orWhereHas('roles', function ($query) use ($search) {
                      $query->where('name', 'LIKE', "%{$search}%");
                  });
        })
        ->whereDoesntHave('roles', function ($query) use ($administratorRoleId) {
            $query->where('id', $administratorRoleId);
        })
        ->count();

      }

      $data = [];

      if (!empty($users)) {
          $ids = $start;

          foreach ($users as $user) {
            $rolesArray = $user->roles->pluck('name')->toArray();
            $nestedData['id'] = $user->id;
            $nestedData['fake_id'] = ++$ids;
            $nestedData['name'] = $user->name;
            $nestedData['email'] = $user->email;
            $nestedData['email_verified_at'] = $user->email_verified_at;
            $nestedData['password'] = $user->password;
            $nestedData['roles'] = $rolesArray;

            $data[] = $nestedData;
          }
      }

      if ($data) {
          return response()->json([
              'draw' => intval($request->input('draw')),
              'recordsTotal' => intval($totalData),
              'recordsFiltered' => intval($totalFiltered),
              'code' => 200,
              'data' => $data,
          ]);
      } else {
          return response()->json([
              'message' => 'Internal Server Error',
              'code' => 500,
              'data' => [],
          ]);
      }
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $userID = $request->id;

    if ($userID) {

      if($request->password == null){
        $user = User::updateOrCreate(
          ['id' => $userID],
          ['name' => $request->name, 'email' => $request->email]
        );

      }
      else {
        $user = User::updateOrCreate(
          ['id' => $userID],
          ['name' => $request->name, 'email' => $request->email, 'password' => bcrypt($request->password)]
        );
      }

      $user->roles()->detach();
      $user->assignRole($request->role);

      // user updated
      return response()->json([
        'title' => 'Kemas Kini Berjaya!',
        'text' => 'Pengguna Berjaya Dikemas Kini.'
    ]);
    } else {
      // create new one if email is unique
      $userEmail = User::where('email', $request->email)->first();

      if (empty($userEmail)) {
        $user = User::updateOrCreate(
          ['id' => $userID],
          ['name' => $request->name, 'email' => $request->email, 'password' => bcrypt($request->password)]
        );

        $user->assignRole($request->role);

        // user created
        return response()->json([
          'title' => 'Tambah Pengguna Berjaya!',
          'text' => 'Pengguna Baru Berjaya Ditambah.'
        ]);
      } else {
        // user already exist
        return response()->json(['message' => "already exits"], 422);
      }
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $where = ['id' => $id];

    $users = User::with(['roles' => function ($query) {
      $query->first(); // Retrieve only the first role
  }])->where($where)->first();

    return response()->json($users);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $user = User::find($id);
    $user->roles()->detach();
    $user->delete();
  }
}
