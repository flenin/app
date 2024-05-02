import { useEffect, useState } from 'react';
import { addDays, getISODay, getDaysInMonth, startOfMonth, subDays, lastDayOfMonth, subMonths, addMonths, isToday, isPast, format, isSameMonth, isBefore, isAfter } from 'date-fns';

export default function Calendar({value, onChange}) {
    const [dates, setDates] = useState([]);
    const [now, setNow] = useState(new Date());

    const calendar = (date) => {
        if (isBefore(date, startOfMonth(new Date()))) {
            return;
        }

        setNow(date);

        const first = startOfMonth(date);
        const days = getDaysInMonth(date);
        const last = lastDayOfMonth(date);

        let array = [];

        if (getISODay(first) > 1) {
            for (let i = 1; i <= getISODay(first) - 1; i++) {
                array = [subDays(first, i), ...array];
            }
        }

        let i = 0;

        do {
            array = [...array, addDays(first, i)];

            i++;
        } while (i < days);

        if (getISODay(last) < 7) {
            for (let i = 1; i <= 7 - getISODay(last); i++) {
                array = [...array, addDays(last, i)];
            }
        }

        setDates(array);
    }

    const select = (e) => {
        onChange({name: 'from_date', value: e.currentTarget.querySelector('time').dateTime});
    }
    
    useEffect(() => calendar(now), []);

    return (
        <>
            <div className="text-center col-start-8 col-end-13 row-start-1">
                <div className="flex items-center text-gray-900">
                    {!isBefore(subMonths(now, 1), startOfMonth(new Date())) && <button type="button" className="-m-1.5 flex flex-none items-center justify-center p-1.5 text-gray-400" onClick={() => calendar(subMonths(now, 1))}>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                            aria-hidden="true" className="h-5 w-5">
                            <path fillRule="evenodd"
                                d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                clipRule="evenodd"></path>
                        </svg>
                    </button>}
                    <div className="flex-auto text-sm font-semibold">{format(now, 'MMMM')} {format(now, 'y')}</div>
                    {!isAfter(addMonths(startOfMonth(now), 1), addMonths(new Date(), 3)) && <button type="button" className="-m-1.5 flex flex-none items-center justify-center p-1.5 text-gray-400" onClick={() => calendar(addMonths(now, 1))}>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                            aria-hidden="true" className="h-5 w-5">
                            <path fillRule="evenodd"
                                d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                clipRule="evenodd"></path>
                        </svg>
                    </button>}
                </div>
                <div className="mt-6 grid grid-cols-7 text-xs leading-6 text-gray-500">
                    <div>L</div>
                    <div>M</div>
                    <div>M</div>
                    <div>J</div>
                    <div>V</div>
                    <div>S</div>
                    <div>D</div>
                </div>
                <div className="isolate mt-2 grid grid-cols-7 gap-px rounded-lg bg-gray-200 text-sm shadow ring-1 ring-gray-200">
                    {dates.map((v, i) => {
                        return (
                            <button
                                type="button"
                                className={`py-1.5 ${value == format(v, 'yyyy-MM-dd') ? `font-semibold text-white` : ``} ${isToday(v) ? `bg-white font-semibold text-indigo-600` : isPast(v) || !isSameMonth(v, now) ? `bg-gray-50 text-gray-400` : `bg-white text-gray-900`} ${i == 0 ? `rounded-tl-lg` : ``} ${i == 6 ? `rounded-tr-lg` : ``} ${i == (dates.length - 1 - 6) ? `rounded-bl-lg` : ``} ${i == (dates.length - 1) ? `rounded-br-lg` : ``}`}
                                onClick={select}
                                key={i}
                            >
                                <time dateTime={format(v, 'yyyy-MM-dd')} className={`mx-auto flex h-7 w-7 items-center justify-center rounded-full ${value == format(v, 'yyyy-MM-dd') ? `bg-gray-900` : ``}`}>{format(v, 'd')}</time>
                            </button>
                        )
                    })}
                    {/* <button type="button" className="py-1.5 bg-gray-50 text-gray-400 rounded-tl-lg">
                        <time dateTime="2021-12-27" className="mx-auto flex h-7 w-7 items-center justify-center rounded-full">27</time>
                    </button>
                    <button type="button" className="py-1.5 bg-gray-50 text-gray-400">
                        <time dateTime="2021-12-28" className="mx-auto flex h-7 w-7 items-center justify-center rounded-full">28</time>
                    </button>
                    <button type="button" className="py-1.5 bg-gray-50 text-gray-400">
                        <time dateTime="2021-12-29" className="mx-auto flex h-7 w-7 items-center justify-center rounded-full">29</time>
                    </button>
                    <button type="button" className="py-1.5 bg-gray-50 text-gray-400">
                        <time dateTime="2021-12-30" className="mx-auto flex h-7 w-7 items-center justify-center rounded-full">30</time>
                    </button>
                    <button type="button" className="py-1.5 bg-gray-50 text-gray-400">
                        <time dateTime="2021-12-31" className="mx-auto flex h-7 w-7 items-center justify-center rounded-full">31</time>
                    </button>
                    <button type="button" className="py-1.5 bg-white text-gray-900">
                        <time dateTime="2022-01-01" className="mx-auto flex h-7 w-7 items-center justify-center rounded-full">1</time>
                    </button>
                    <button type="button" className="py-1.5 bg-white text-gray-900 rounded-tr-lg">
                        <time dateTime="2022-01-02" className="mx-auto flex h-7 w-7 items-center justify-center rounded-full">2</time>
                    </button>
                    <button type="button" className="py-1.5 bg-white text-gray-900">
                        <time dateTime="2022-01-03" className="mx-auto flex h-7 w-7 items-center justify-center rounded-full">3</time>
                    </button>
                    <button type="button" className="py-1.5 bg-white text-gray-900">
                        <time dateTime="2022-01-04" className="mx-auto flex h-7 w-7 items-center justify-center rounded-full">4</time>
                    </button>
                    <button type="button" className="py-1.5 bg-white text-gray-900">
                        <time dateTime="2022-01-05" className="mx-auto flex h-7 w-7 items-center justify-center rounded-full">5</time>
                    </button>
                    <button type="button" className="py-1.5 bg-white text-gray-900">
                        <time dateTime="2022-01-06" className="mx-auto flex h-7 w-7 items-center justify-center rounded-full">6</time>
                    </button>
                    <button type="button" className="py-1.5 bg-white text-gray-900">
                        <time dateTime="2022-01-07" className="mx-auto flex h-7 w-7 items-center justify-center rounded-full">7</time>
                    </button>
                    <button type="button" className="py-1.5 bg-white text-gray-900">
                        <time dateTime="2022-01-08" className="mx-auto flex h-7 w-7 items-center justify-center rounded-full">8</time>
                    </button>
                    <button type="button" className="py-1.5 bg-white text-gray-900">
                        <time dateTime="2022-01-09" className="mx-auto flex h-7 w-7 items-center justify-center rounded-full">9</time>
                    </button>
                    <button type="button" className="py-1.5 bg-white text-gray-900">
                        <time dateTime="2022-01-10" className="mx-auto flex h-7 w-7 items-center justify-center rounded-full">10</time>
                    </button>
                    <button type="button" className="py-1.5 bg-white text-gray-900">
                        <time dateTime="2022-01-11" className="mx-auto flex h-7 w-7 items-center justify-center rounded-full">11</time>
                    </button>
                    <button type="button" className="py-1.5 bg-white font-semibold text-indigo-600">
                        <time dateTime="2022-01-12" className="mx-auto flex h-7 w-7 items-center justify-center rounded-full">12</time>
                    </button>
                    <button type="button" className="py-1.5 bg-white text-gray-900">
                        <time dateTime="2022-01-13" className="mx-auto flex h-7 w-7 items-center justify-center rounded-full">13</time>
                    </button>
                    <button type="button" className="py-1.5 bg-white text-gray-900">
                        <time dateTime="2022-01-14" className="mx-auto flex h-7 w-7 items-center justify-center rounded-full">14</time>
                    </button>
                    <button type="button" className="py-1.5 bg-white text-gray-900">
                        <time dateTime="2022-01-15" className="mx-auto flex h-7 w-7 items-center justify-center rounded-full">15</time>
                    </button>
                    <button type="button" className="py-1.5 bg-white text-gray-900">
                        <time dateTime="2022-01-16" className="mx-auto flex h-7 w-7 items-center justify-center rounded-full">16</time>
                    </button>
                    <button type="button" className="py-1.5 bg-white text-gray-900">
                        <time dateTime="2022-01-17" className="mx-auto flex h-7 w-7 items-center justify-center rounded-full">17</time>
                    </button>
                    <button type="button" className="py-1.5 bg-white text-gray-900">
                        <time dateTime="2022-01-18" className="mx-auto flex h-7 w-7 items-center justify-center rounded-full">18</time>
                    </button>
                    <button type="button" className="py-1.5 bg-white text-gray-900">
                        <time dateTime="2022-01-19" className="mx-auto flex h-7 w-7 items-center justify-center rounded-full">19</time>
                    </button>
                    <button type="button" className="py-1.5 bg-white text-gray-900">
                        <time dateTime="2022-01-20" className="mx-auto flex h-7 w-7 items-center justify-center rounded-full">20</time>
                    </button>
                    <button type="button" className="py-1.5 bg-white text-gray-900">
                        <time dateTime="2022-01-21" className="mx-auto flex h-7 w-7 items-center justify-center rounded-full">21</time>
                    </button>
                    <button type="button" className="py-1.5 bg-white font-semibold text-white">
                        <time dateTime="2022-01-22" className="mx-auto flex h-7 w-7 items-center justify-center rounded-full bg-gray-900">22</time>
                    </button>
                    <button type="button" className="py-1.5 bg-white text-gray-900">
                        <time dateTime="2022-01-23" className="mx-auto flex h-7 w-7 items-center justify-center rounded-full">23</time>
                    </button>
                    <button type="button" className="py-1.5 bg-white text-gray-900">
                        <time dateTime="2022-01-24" className="mx-auto flex h-7 w-7 items-center justify-center rounded-full">24</time>
                    </button>
                    <button type="button" className="py-1.5 bg-white text-gray-900">
                        <time dateTime="2022-01-25" className="mx-auto flex h-7 w-7 items-center justify-center rounded-full">25</time>
                    </button>
                    <button type="button" className="py-1.5 bg-white text-gray-900">
                        <time dateTime="2022-01-26" className="mx-auto flex h-7 w-7 items-center justify-center rounded-full">26</time>
                    </button>
                    <button type="button" className="py-1.5 bg-white text-gray-900">
                        <time dateTime="2022-01-27" className="mx-auto flex h-7 w-7 items-center justify-center rounded-full">27</time>
                    </button>
                    <button type="button" className="py-1.5 bg-white text-gray-900">
                        <time dateTime="2022-01-28" className="mx-auto flex h-7 w-7 items-center justify-center rounded-full">28</time>
                    </button>
                    <button type="button" className="py-1.5 bg-white text-gray-900">
                        <time dateTime="2022-01-29" className="mx-auto flex h-7 w-7 items-center justify-center rounded-full">29</time>
                    </button>
                    <button type="button" className="py-1.5 bg-white text-gray-900">
                        <time dateTime="2022-01-30" className="mx-auto flex h-7 w-7 items-center justify-center rounded-full">30</time>
                    </button>
                    <button type="button" className="py-1.5 bg-white text-gray-900 rounded-bl-lg">
                        <time dateTime="2022-01-31" className="mx-auto flex h-7 w-7 items-center justify-center rounded-full">31</time>
                    </button>
                    <button type="button" className="py-1.5 bg-gray-50 text-gray-400">
                        <time dateTime="2022-02-01" className="mx-auto flex h-7 w-7 items-center justify-center rounded-full">1</time>
                    </button>
                    <button type="button" className="py-1.5 bg-gray-50 text-gray-400">
                        <time dateTime="2022-02-02" className="mx-auto flex h-7 w-7 items-center justify-center rounded-full">2</time>
                    </button>
                    <button type="button" className="py-1.5 bg-gray-50 text-gray-400">
                        <time dateTime="2022-02-03" className="mx-auto flex h-7 w-7 items-center justify-center rounded-full">3</time>
                    </button>
                    <button type="button" className="py-1.5 bg-gray-50 text-gray-400">
                        <time dateTime="2022-02-04" className="mx-auto flex h-7 w-7 items-center justify-center rounded-full">4</time>
                    </button>
                    <button type="button" className="py-1.5 bg-gray-50 text-gray-400">
                        <time dateTime="2022-02-05" className="mx-auto flex h-7 w-7 items-center justify-center rounded-full">5</time>
                    </button>
                    <button type="button" className="py-1.5 bg-gray-50 text-gray-400 rounded-br-lg">
                        <time dateTime="2022-02-06" className="mx-auto flex h-7 w-7 items-center justify-center rounded-full">6</time>
                    </button> */}
                </div>
            </div>
        </>
    );
}
