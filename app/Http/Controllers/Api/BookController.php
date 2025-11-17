<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Http\Requests\BookFilterRequest;
use Illuminate\Http\JsonResponse;

class BookController extends Controller
{
    /**
     * GET /books — Filters + Sorting + Pagination
     */
    public function index(BookFilterRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $query = Book::query()
            ->with([
                'authors',
                'subjects',
                'bookshelves',
                'languages',
                'formats'
            ])
            ->orderByDesc('download_count'); // popularity sorting

        // 🔍 Filter by IDs (multiple IDs supported)
        if (!empty($validated['ids'] ?? null)) {
            $ids = explode(',', $validated['ids']);
            $query->whereIn('id', $ids);
        }

        // 🔍 Filter by title (case-insensitive partial)
        if (!empty($validated['title'] ?? null)) {
            $titles = explode(',', $validated['title']);

            $query->where(function ($q) use ($titles) {
                foreach ($titles as $title) {
                    $title = trim($title); // extra spaces remove
                    $q->orWhere('title', 'ILIKE', "%{$title}%");
                }
            });
        }

        // 🔍 Filter by author name
        if (!empty($validated['author'] ?? null)) {
            $authors = explode(',', $validated['author']);
            $query->whereHas('authors', function ($q) use ($authors) {
                foreach ($authors as $author) {
                    $q->where('name', 'ILIKE', '%' . trim($author) . '%');
                }
            });
        }

        // 🔍 Filter by language code
        if (!empty($validated['language'] ?? null)) {
            $languages = explode(',', $validated['language']);
            $query->whereHas('languages', function ($q) use ($languages) {
                $q->whereIn('code', $languages);
            });
        }

        // 🔍 Filter by mime-type
        if (!empty($validated['mime_type'] ?? null)) {
            $mimeTypes = explode(',', $validated['mime_type']);
            $query->whereHas('formats', function ($q) use ($mimeTypes) {
                $q->whereIn('mime_type', $mimeTypes);
            });
        }

        // 🔍 Filter by topic (subjects + bookshelves)
        if (!empty($validated['topic'] ?? null)) {
            $topics = explode(',', $validated['topic']);

            $query->where(function ($q) use ($topics) {
                $q->whereHas('subjects', function ($q2) use ($topics) {
                    foreach ($topics as $topic) {
                        $q2->where('name', 'ILIKE', '%' . trim($topic) . '%');
                    }
                });

                $q->orWhereHas('bookshelves', function ($q3) use ($topics) {
                    foreach ($topics as $topic) {
                        $q3->where('name', 'ILIKE', '%' . trim($topic) . '%');
                    }
                });
            });
        }

        // 📌 Pagination: 25 per page
        $books = $query->paginate(25);

        // 📌 Response format
        return response()->json([
            'count' => $books->total(),
            'next_page' => $books->nextPageUrl(),
            'prev_page' => $books->previousPageUrl(),
            'results' => $books->items()
        ]);
    }


    /**
     * GET /books/{id}
     */
    public function show(int $id): JsonResponse
    {
        $book = Book::with([
            'authors',
            'subjects',
            'bookshelves',
            'languages',
            'formats'
        ])->findOrFail($id);

        return response()->json($book);
    }
}
