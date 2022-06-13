<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;

trait HasProfileHeaderPhoto
{
    /**
     * Update the user's profile photo.
     *
     * @param  \Illuminate\Http\UploadedFile  $photo
     * @return void
     */
    public function updateProfileHeaderPhoto(UploadedFile $photo)
    {
        tap($this->profile_header_photo_path, function ($previous) use ($photo) {
            if($photo){
                $file = $photo;
                $filename = $file->getClientOriginalName();
                $this->forceFill([
                    'profile_header_photo_path' => $file->storeAs('avatars', $filename, 's3')])->save();
            }

            if ($previous) {
                Storage::disk($this->profileHeaderPhotoDisk())->delete($previous);
            }
        });
    }

    /**
     * Delete the user's profile photo.
     *
     * @return void
     */
    public function deleteProfileHeaderPhoto()
    {
        if (! Features::managesProfilePhotos()) {
            return;
        }

        if (is_null($this->profile_header_photo_path)) {
            return;
        }

        Storage::disk($this->profileHeaderPhotoDisk())->delete($this->profile_header_photo_path);

        $this->forceFill([
            'profile_header_photo_path' => null,
        ])->save();
    }

    /**
     * Get the URL to the user's profile photo.
     *
     * @return string
     */
    public function getProfileHeaderPhotoUrlAttribute()
    {
        return $this->profile_header_photo_path
                    ? Storage::disk($this->profileHeaderPhotoDisk())->url($this->profile_header_photo_path)
                    : $this->defaultProfileHeaderPhotoUrl();
    }

    /**
     * Get the default profile photo URL if no profile photo has been uploaded.
     *
     * @return string
     */
    protected function defaultProfileHeaderPhotoUrl()
    {
        $name = trim(collect(explode(' ', $this->name))->map(function ($segment) {
            return mb_substr($segment, 0, 1);
        })->join(' '));

        return 'https://ui-avatars.com/api/?name='.urlencode($name).'&color=7F9CF5&background=EBF4FF';
    }

    /**
     * Get the disk that profile photos should be stored on.
     *
     * @return string
     */
    protected function profileHeaderPhotoDisk()
    {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : config('jetstream.profile_header_photo_disk', 's3');
    }
}
