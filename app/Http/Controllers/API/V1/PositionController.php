<?php
namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Position;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserIndexRequest;

class PositionController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

  public function index(UserIndexRequest $request)
{
    $count = $request->input('count', 6);
    $offset = $request->input('offset', 0);
    $page = $request->input('page', 1);

    $users = User::offset($offset)->limit($count)->paginate($count, ['*'], 'page', $page);

    if ($request->wantsJson()) {
        return response()->json([
            'success' => true,
            'page' => $users->currentPage(),
            'total_pages' => $users->lastPage(),
            'total_users' => $users->total(),
            'count' => $users->count(),
            'links' => [
                'next_url' => $users->nextPageUrl(),
                'prev_url' => $users->previousPageUrl(),
            ],
            'users' => $users->items(),
        ]);
    } else {
        return view('index', compact('users'));
    }
}

    public function getUserById(Request $request)
    {
        $userId = $request->input('id');
        $result = $this->userService->getUserById($userId);

        return response()->json($result);
    }

   public function getToken()
{
    $user = Auth::user(); // Getting the current authenticated user
    $result = $this->userService->getToken($user);
    return response()->json($result);
}

    public function getPositions()
    {
        try {
            $positions = Position::all();
            return response()->json([
                'success' => true,
                'positions' => $positions,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Positions not found',
            ], 404);
        }
    }
}
