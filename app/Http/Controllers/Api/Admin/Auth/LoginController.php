<?php

namespace App\Http\Controllers\Api\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'refresh']);
    }

    /**
     * login
     *
     * Get a JWT token via given credentials.
     *
     * @param LoginRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @OA\Post(
     *   tags={"General"},
     *   path="/login",
     *   description="Get a JWT via credentials",
     *   @OA\RequestBody(
     *     request="LoginRequest",
     *     description="Login Request",
     *     required=true,
     *     @OA\JsonContent(
     *       @OA\Property(
     *         property="email",
     *         type="string",
     *         format="email",
     *         maximum=255
     *       ),
     *       @OA\Property(
     *         property="password",
     *         type="string",
     *         minimum=6
     *       ),
     *       required={"email", "password"},
     *       example={"email": "test@test.com", "password": "123456"}
     *     )
     *   ),
     *   @OA\Response(response="200", description="Success login", @OA\JsonContent()),
     *   @OA\Response(response="401", description="Invalid credentials", @OA\JsonContent()),
     *   @OA\Response(response="422", description="Validation errors", @OA\JsonContent())
     * )
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['message' => 'Invalid username or password.'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * logout
     *
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @OA\Post(
     *   tags={"General"},
     *   path="/logout",
     *   description="Logout",
     *   @OA\Response(response="204", description="Success login", @OA\JsonContent()),
     *   @OA\Response(response="401", description="Unauthorized", @OA\JsonContent()),
     *   security={{"bearer":{}}}
     * )
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(null, 204);
    }

    /**
     * refresh
     *
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @OA\Post(
     *   tags={"General"},
     *   path="/refresh",
     *   description="Refresh JWT token",
     *   @OA\Response(response="200", description="Success login", @OA\JsonContent()),
     *   @OA\Response(response="401", description="Unauthorized", @OA\JsonContent()),
     *   security={{"bearer":{}}}
     * )
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'data' => [
                'access_token' => $token,
                'token_type'   => 'bearer',
                'expires_in'   => auth()->factory()->getTTL() * 60
            ]
        ]);
    }
}