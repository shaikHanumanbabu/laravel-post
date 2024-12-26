<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Get paginated posts, default 10 per page
        $posts = Post::orderBy('created_at', 'Desc')->paginate($request->get('per_page', 100)); // Use 'per_page' query parameter to customize page size

        return response()->json($posts, 200);
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
        try {
            // validate the incoming request
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'priority' => 'required|in:low,medium,high',
                'due_date' => 'required|date',
            ], [
                'title.required' => 'Please provide a title for the post.',
                'priority.in' => 'Priority must be one of: low, medium, or high.',
                'due_date.date' => 'The due date must be a valid date.',
            ]);
    
            // Create the post
            $post = Post::create($validated);
    
            // Return the created post
            return response()->json(['message' => 'Post created successfully', 'post' => $post], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Return validation error messages
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($post = null)
    {
        $post = Post::find($post);
        // Check if the post exists before attempting to delete
        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }
        // Return the post
        return response()->json(['post' => $post], 200);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dueInSevenDays()
    {
        
        $post = Post::dueInNextSevenDays()->get();

        
        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }
        // Return the post
        return response()->json(['due_posts' => $post], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $post)
    {
        $post = Post::find($post);
        // Check if the post exists before attempting to delete
        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }
        // Validate the incoming request data
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'priority' => 'sometimes|required|in:low,medium,high',
            'due_date' => 'sometimes|required|date',
        ], [
            'title.required' => 'Please provide a title for the post.',
            'priority.in' => 'Priority must be one of: low, medium, or high.',
            'due_date.date' => 'The due date must be a valid date.',
        ]);

        // Update the post
        $post->update($validated);

        // Return the updated post
        return response()->json(['message' => 'Post updated successfully', 'post' => $post], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($post = null)
    {
        $post = Post::find($post);
        // Check if the post exists before attempting to delete
        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }
        // Delete the post
        $post->delete();

        // Return a success message
        return response()->json(['message' => 'Post deleted successfully'], 200);
    }
}
