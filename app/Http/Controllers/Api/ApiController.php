<?php namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Haircut;
use App\Models\HaircutPack;
use App\Models\PackedHaircutSelection;
use App\Models\Quiz;
use App\Models\QuizAnswer;
use App\Models\QuizQuestionOption;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * @SWG\Swagger(
     *     basePath="/api/v1",
     *     schemes={"http"},
     *     host=L5_SWAGGER_CONST_HOST,
     *     @SWG\Info(
     *         version="1.0.0",
     *         title="Quiz app API",
     *         description="Quiz app REST API",
     *         @SWG\Contact(
     *             email="shoxyoyo@gmail.com"
     *         ),
     *     )
     * )
     */
    /**
     * @SWG\Get(
     *      path="/haircuts",
     *      operationId="getHaircuts",
     *      tags={"Haircuts"},
     *      summary="Get list of haircuts",
     *      description="Returns list of haircuts (including image urls)",
     *      @SWG\Parameter(
     *          name="answerId",
     *          description="Id of answer for quiz 2 (long/short/medium)",
     *          in="query",
     *          required=false,
     *          type="integer"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *       @SWG\Response(response=400, description="Bad request")
     *     )
     */

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function haircuts(Request $request)
    {
        $idsMapping = [
            31 => 'short',
            32 => 'medium',
            33 => 'long',
        ];
        // FIXME move this cache middleware someday
        $filterTo = $idsMapping[(int)$request->get('answerId')] ?? null;
        $cacheKey = 'haircuts.' . ($filterTo ?: 'all');
        $haircuts = \Cache::rememberForever($cacheKey, function () use ($filterTo) {
            $builder = Haircut::notPacked();
            if ($filterTo) {
                $builder = $builder->where('type', $filterTo);
            }
            return $builder->get()->toArray();
        });
        return response()->json($haircuts);
    }

    /**
     * @SWG\Get(
     *      path="/quizzes",
     *      operationId="getQuizzes",
     *      tags={"Quizzes"},
     *      summary="Get list of haircuts",
     *      description="Returns list of all quizzes with their questions",
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *       @SWG\Response(response=400, description="Bad request")
     *     )
     *
     */
    public function quizzes()
    {
        $haircuts = \Cache::rememberForever('quizzes.all', function () {
            return Quiz::all()->toArray();
        });
        return response()->json($haircuts);
    }

    /**
     * @SWG\Post(
     *      path="/quizzes/{quizId}/answers",
     *      operationId="storeQuizAnswers",
     *      tags={"Quizzes"},
     *      summary="Store quiz answers",
     *      description="Store quiz answers and return needed haircut if needed",
     *      @SWG\Parameter(
     *          name="quizId",
     *          description="Quiz id",
     *          in="path",
     *          required=true,
     *          type="integer"
     *      ),
     *      @SWG\Parameter(
     *          name="answers",
     *          description="JSON representation of user answers, e.g {questionId => answerId}",
     *          in="formData",
     *          required=true,
     *          type="string",
     *          format="json"
     *      ),
     *      @SWG\Parameter(
     *          name="haircutId",
     *          description="id of selected haircut (only for quiz 2)",
     *          in="formData",
     *          required=false,
     *          type="integer"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *       @SWG\Response(response=400, description="Bad request")
     *     )
     */
    /**
     * @param Quiz $quiz
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function storeAnswers(Quiz $quiz, Request $request)
    {
        // this and some other additional logic (e.g deny submit 2nd quiz with >2 answers)
        // actually should be in form request, but who cares =\
        $request->validate([
            'answers' => 'required|json',
        ]);
        $answers = \json_decode($request->get('answers', ''), JSON_OBJECT_AS_ARRAY);
        switch ($quiz->id) {
            case 1:
                $selectedHaircut = $this->processFirstQuizAnswers($answers);
                $this->createQuizAnswer($quiz, $answers, $selectedHaircut);
                return response()->json([
                    'haircut' => $selectedHaircut,
                ]);
                break;
            case 2:
                $age = QuizQuestionOption::findOrFail(\last($answers))->text;
                /** @var Haircut $selectedHaircut */
                $selectedHaircut = Haircut::findOrFail((int)$request->get('haircutId'));
                $this->createQuizAnswer($quiz, $answers, $selectedHaircut, $age);
                return response()->json();
                break;
            default:
                throw new \Exception('Quiz unsupported yet');
        }
    }

    /**
     * This is also out of controller's responsibility
     *
     * @param array $answers
     * @return Haircut|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    private function processFirstQuizAnswers(array $answers): Haircut
    {
        /*Group1: For question 3 answer 2 is choosed.
         Group2: For question 4 answer 2 is choosed.
         Group3: For question 6 answer 1 is choosed.
         Group4: For question 6 answer 2 or 3 is choosed.
         Group5: For question 6 answer 1 is choosed.
         Group6: For question 4 answer 1 is choosed.
        */

        $conditions = \array_keys(\array_filter([
            ($answers[3] ?? 0) == 8, // group 1
            (($answers[4] ?? 0) == 11), // group 2
            (($answers[6] ?? 0) == 16), // group 3 or 5
            (($answers[6] ?? 0) == 17 || ($answers[6] ?? 0) == 18), // group 4
            (($answers[4] ?? 0) == 10), // group 6
        ]));

        if (!$conditions || \rand(1, 3) == 3) { // with possibiliy of 33% returning short 2 haircut
            return Haircut::findOrFail(82); // short 2
        }
        \shuffle($conditions);
        $selectedGroup = Haircut::GROUPS[\head($conditions)];
        \shuffle($selectedGroup);
        return Haircut::findOrFail(\head($selectedGroup));
    }

    private function createQuizAnswer(Quiz $quiz, array $answers, Haircut $selectedHaircut, string $age = '')
    {
        $answer = new QuizAnswer;
        $answer->answers = $answers;
        $answer->quiz_id = $quiz->id;
        $answer->haircut_id = $selectedHaircut->id;
        $answer->age = $age;
        $answer->save();
    }

    /**
     * @SWG\Get(
     *      path="/packed-haircuts",
     *      operationId="getPackedHaircuts",
     *      tags={"Haircuts"},
     *      summary="Get list of packed haircuts",
     *      description="Returns list of packed haircuts (including image urls)",
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *       @SWG\Response(response=400, description="Bad request")
     *     )
     */
    public function packedHaircuts()
    {
        $response = \Cache::rememberForever('packed-haircuts.all', function () {
            return HaircutPack::with('haircuts')->get()->toArray();
        });

        return response()->json($response);
    }

    /**
     * @SWG\Post(
     *      path="/packed-haircuts/{haircutId}",
     *      operationId="storeHaircutSelection",
     *      tags={"Haircuts"},
     *      summary="Store haircut selection",
     *      description="Store selection of haircut",
     *      @SWG\Parameter(
     *          name="haircutId",
     *          description="HaircutId",
     *          in="path",
     *          required=true,
     *          type="integer"
     *      ),
     *      @SWG\Response(
     *          response=201,
     *          description="successful operation"
     *       ),
     *       @SWG\Response(response=400, description="Bad request")
     *     )
     */

    /**
     * @param Haircut $haircut
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function submitPackedSelection(Haircut $haircut)
    {
        if (!$haircut->haircut_pack_id) {
            throw new \Exception('This feature is available only for haircuts with assigned pack');
        }
        /** @var PackedHaircutSelection $selection */
        $selection = PackedHaircutSelection::firstOrCreate([
            'haircut_id' => $haircut->id,
        ]);
        $selection->count += 1;
        $selection->save();
        return \response()->json([], 201);
    }
}
