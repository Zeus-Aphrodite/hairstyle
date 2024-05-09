@extends('admin.layout')

@section('content')
    <div class="page-title">
        <h3>Quiz stats</h3>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="grid simple">
                <div class="grid-body no-border">
                    <h3>Quiz 2 results</h3>
                    <table class="table no-more-tables">
                        <thead>
                        <tr>
                            <th>Hairstyle</th>
                            @foreach ($quiz2Options as $option)
                                <th>{{ $option }}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($haircuts as $haircut)
                            <tr>
                                <td>
                                    {{ $haircut->name }} ({{ $haircut->type }})
                                    @if ($haircut->is_free)
                                        <span class="label label-success">Free</span>
                                    @else
                                        <span class="label label-warning">Paid</span>
                                    @endif
                                </td>

                                @foreach ($quiz2Options as $option)
                                    <?php $totalHaircutAnswers = $haircut->getAnswersCountForQuiz2() ?>
                                    <td>
                                        @if ($totalHaircutAnswers)
                                            {{ \round($haircut->getAnswersCountForQuiz2($option) / max($totalHaircutAnswers, 1), 2) * 100 }}%
                                        @else
                                            0%
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="grid simple">
                <div class="grid-body no-border">
                    <h3>Resulting table includes both quiz 1 and quiz 2 results</h3>
                    <table class="table no-more-tables">
                        <thead>
                            <tr>
                                <th>Hairstyle</th>
                                <th>Choosed</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($haircuts as $haircut)
                                <tr>
                                    <td>
                                        {{ $haircut->name }} ({{ $haircut->type }})
                                        @if ($haircut->is_free)
                                            <span class="label label-success">Free</span>
                                        @else
                                            <span class="label label-warning">Paid</span>
                                        @endif
                                    </td>
                                    <td>
                                        <?php
                                            $selectedTimes = \App\Models\QuizAnswer::forHaircut($haircut)->count();
                                            $percentage = \round($selectedTimes / max($totalAnswersCount, 1), 2) * 100;
                                        ?>
                                        {{ $selectedTimes }} ({{ $percentage }}%)
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
