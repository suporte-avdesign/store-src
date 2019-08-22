<?php

namespace AVD\Repositories\Web;

use AVD\Models\Web\User as Model;
use AVD\Interfaces\Web\UserInterface;
use AVD\Interfaces\Web\AccountTypeInterface as InterAccountType;
use AVD\Interfaces\Web\ConfigProfileClientInterface as InterProfile;

use AVD\Events\UserRegisteredNoteEvent;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserRepository implements UserInterface
{
    /**
     * @var Model
     */
    private $model;
    /**
     * @var InterProfile
     */
    private $interProfile;
    /**
     * @var InterAccountType
     */
    private $interAccountType;


    /**
     * Create construct.
     *
     * @return void
     */
    public function __construct(
        Model $model,
        InterProfile $interProfile,
        InterAccountType $interAccountType)
    {

        $this->model = $model;
        $this->interProfile = $interProfile;
        $this->interAccountType = $interAccountType;
    }


    /**
     * Date: 07/01/2019
     *
     * @param  int Id
     * @return mixed
     */
    public function setId($id)
    {
        return $this->model->find($id);
    }


    public function setEmail($email)
    {
        return $this->model->where('email', $email)->first();
    }


    public function setToken($token)
    {
        return $this->model->where('token', $token)->first();
    }


    public function access($access, $id)
    {
        $data = $this->setId($id);
        return $data->update($access);
    }


    /**
     * Date: 07/01/2019
     *
     * @param $input
     * @return bool
     */
    public function create($input)
    {
        $input['first_name'] = $input["first_name_{$input['type_id']}"];
        $input['last_name']  = $input["last_name_{$input['type_id']}"];
        $input['document1']  = $input["document1_{$input['type_id']}"];
        $input['document2']  = $input["document2_{$input['type_id']}"];
        $input['active']     = constLang('active_false');
        $input['token']      = Str::random(40);
        $input['ip']         = $_SERVER['REMOTE_ADDR'];

        $user = $this->model->create($input);
        if ($user) {
            $note = $this->createNote($user);
            return $user;
        }
        return false;
    }

    /**
     * Update User
     *
     * @param $input
     * @return bool|string
     */
    public function update($input, $page)
    {
        $id   = Auth::id();
        $note = constLang('updated')." ";
        $data = $this->model->find($id);
        $dataForm = null;

        if ($data->profile_id != $input['profile_id']) {
            $dataForm['profile_id'] = $input['profile_id'];
            $note .= constLang('profile').
                ":{$data->profile->name}/{$this->interProfile->getName($input['profile_id'])}, ";
        }
        if ($data->type_id != $input['type_id']) {
            $dataForm['type_id'] = $input['type_id'];
            $note .= constLang('type')
                .":".$this->interAccountType->getName($data->type_id).
                "/".$this->interProfile->getName($input['type_id']).", ";
        }
        if ($data->first_name != $input["first_name_{$input['type_id']}"]) {
            $dataForm['first_name'] = $input["first_name_{$input['type_id']}"];
            if ($input['type_id'] == 1) {
                $note .= constLang('person_legal.first_name').
                    ":{$data->first_name}/".$input["first_name_{$input['type_id']}"].", ";
            } else {
                $note .= constLang('person_physical.first_name').
                    ":{$data->first_name}/".$input["first_name_{$input['type_id']}"].", ";
            }
        }

        if ($data->last_name != $input["last_name_{$input['type_id']}"]) {
            $dataForm['last_name'] = $input["last_name_{$input['type_id']}"];
            if ($input['type_id'] == 1) {
                $note .= constLang('person_legal.last_name').
                    ":{$data->last_name}/".$input["last_name_{$input['type_id']}"].", ";
            } else {
                $note .= constLang('person_physical.last_name').
                    ":{$data->last_name}/".$input["last_name_{$input['type_id']}"].", ";
            }
        }

        if ($data->document1 != $input["document1_{$input['type_id']}"]) {
            $dataForm['document1'] = $input["document1_{$input['type_id']}"];
            if ($input['type_id'] == 1) {
                $note .= constLang('person_legal.document1').
                    ":{$data->document1}/".$input["document1_{$input['type_id']}"].", ";
            } else {
                $note .= constLang('person_physical.document1').
                    ":{$data->document1}/".$input["document1_{$input['type_id']}"].", ";
            }
        }

        if ($data->document2 != $input["document2_{$input['type_id']}"]) {
            $dataForm['document2'] = $input["document2_{$input['type_id']}"];
            if ($input['type_id'] == 1) {
                $note .= constLang('person_legal.document2').
                    ":{$data->document2}/".$input["document2_{$input['type_id']}"].", ";
            } else {
                $note .= constLang('person_physical.document2').
                    ":{$data->document2}/".$input["document2_{$input['type_id']}"].", ";
            }
        }

        if ($data->email != $input["email"]) {
            $dataForm['email'] = $input["email"];
            $note .= constLang('email').
                ":{$data->email}/".$input["email"].", ";
        }
        if ($data->cell != $input["cell"]) {
            $dataForm['cell'] = $input["cell"];
            $note .= constLang('cell').
                ":{$data->cell}/".$input["cell"].", ";
        }
        if ($data->phone != $input["phone"]) {
            $dataForm['phone'] = $input["phone"];
            $note .= constLang('phone').
                ":{$data->phone}/".$input["phone"].", ";
        }
        if ($data->date != $input["date"]) {
            $dataForm['date'] = $input["date"];
            $note .= constLang('date_birth').
                ":{$data->date}/".$input["date"].", ";
        }

        if (isset($input["password"])) {
            $dataForm['password'] = $input["password"];
            $note .= constLang('password')."*****, ";
        }

        if ($dataForm) {
            $update = $data->update($dataForm);
            if ($update) {
                $this->updateNote(substr($note, 0, -2), $page);
                return $update;
            }
        }
        return false;
    }


    private function createNote($user)
    {
        $note = [
            'user_id' => $user->id,
            'admin' => constLang('profile_name.user'),
            'label' => constLang('register'),
            'description' => ipLocation()
        ];

        event(new UserRegisteredNoteEvent($note));
    }

    private function updateNote($description, $page)
    {
        $note = [
            'user_id' => Auth::id(),
            'admin' => constLang('profile_name.user'),
            'label' => $page,
            'description' => $description." ".ipLocation()
        ];

        event(new UserRegisteredNoteEvent($note));
    }


    public function logout($id)
    {
        $data  = $this->setId($id);
        $input = ["logout" => date('Y-m-d H:i:s')];
        return $data->update($input);
    }



}