<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $is_deleted
 * @property string $created_at
 * @property string $updated_at
 * @property Collection $formSections
 * @property Collection $sectionSubSections
 */
class Section extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'section';

    /**
     * @var array
     */
    protected $fillable = ['name', 'description', 'is_deleted', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function formSections()
    {
        return $this->belongsToMany('App\FormSection');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sectionSubSections()
    {
        return $this->belongsToMany(SubSection::class, 'section_sub_section');
    }
}
