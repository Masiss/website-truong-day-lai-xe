<?php

namespace App\Actions;

class GetOverviewDocumentAction
{
    public static function handle($documents)
    {
        return $documents->map(function ($document) {
            foreach ($document->content->blocks as $block) {
                if ($block->type === 'header') {
                    $document->title = $block->data->text;
                }
                if ($block->type === 'image') {
                    $document->image = $block->data->file->url;
                }
                $document->hasAtt = $block->type === 'attaches' ? true : false;
            }
            $document->title = $document->title ?? '<Trống>';
            return $document;
        }
        )->map(function ($document) {
            foreach ($document->content->blocks as $block) {
                if ($block->type === 'paragraph') {
                    $document->subtitle = substr($block->data->text, 0, 250);
                    break;
                }
            }
            return $document;
        });

    }

}
