<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Exception\CommonMarkException;

class News extends Model
{
    /** @use HasFactory<\Database\Factories\NewsFactory> */
    use HasFactory;

    protected $fillable = [
        'titulo',
        'slug',
        'conteudo',
        'imagem_url',
        'autor',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'autor');
    }

    /**
     * Get the news content as HTML.
     *
     * @return string
     */
    public function getHtmlContentAttribute(): string
    {
        try {
            $converter = new CommonMarkConverter([
                'html_input' => 'strip',
                'allow_unsafe_links' => false,
            ]);
            return $converter->convert($this->conteudo ?? '')->getContent();
        } catch (CommonMarkException $e) {
            // Handle parsing error, maybe return plain text or an error message
            return 'Error parsing Markdown: ' . $e->getMessage();
        }
    }

    /**
     * Get a plain text excerpt of the news content.
     *
     * @return string
     */
    public function getExcerptAttribute(): string
    {
        // Use the existing html_content accessor to avoid parsing twice
        $plainText = strip_tags($this->html_content);

        return \Illuminate\Support\Str::limit($plainText, 150);
    }
}
