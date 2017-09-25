اتصال کلید به وب سایت
در کریت شما می توانید کلیدهای معمولی ربات را به وب سایت خود وصل کنید. به این ترتیب هر زمان که کاربر بر روی کلید مورد نظر ضربه می زند اطلاعاتی به وب سایت شما ارسال می شود که شما می توانید آن اطلاعات را بررسی کرده و پاسخ مناسب به کلید ارسال کنید.


برای اتصال کلید های کریت به وب سایت مراحل زیر را انجام دهید:

1- در مد ادمین بر روی کلید معمولی ساخته شده در ربات ضربه بزنید.

2- در منوی مدیریت ربات بر روی اتصال به وب سایت ضربه بزنید.

3- آدرسی که قرار است نتایح به آن اسال شود را در این قسمت وارد کنید.

   توجه: برای امنیت بیشتر بهتر است که از ssl استفاده شود.

54- کلید به وب سایت شما متصل شده است.

مستندات پردازش کلیدها
برای اینکه شما بتوانید کلید های خود را پردازش کنید لازم است از استاندارهای زیر پیروی کنید.

1- نحوه ارسال مقادیر به وب سایت

هر زمان که کاربر بر روی کلید متصل شده به وب سایت ضربه می زند و همچنین در ارتباطات بعدی کاربر با ربات همواره یک درخواست حاوی اطلاعات زیر به آدرس اتصالی ارسال می شود:

$_POST['from_id'] = شناسه منحصر به فرد کاربر
$_POST['from_firstname'] = نام کوچک کاربر
$_POST['from_lastname'] = نام خانوادگی کاربر;
$_POST['from_username'] = نام کاربری کاربر
$_POST['date'] = تاریخ ارسال پیام / ضربه زدن بر روی کلید
$_POST['message_id'] = شناسه منحصر به فرد پیام
$_POST['chat_id'] = شناسه چت
$_POST['private'] = خصوصی یا عمومی بودن پیام
$_POST['button_id'] = شناسه منحصر به فرد کلید
$_POST['bot_username'] = نام کاربری ربات
$_POST['type'] = نوع پیام
$_POST['content'] = محتوای غیر متنی
$_POST['text'] = محتوای متنی
$_POST['session'] = مقادیر سفارشی
$_POST['state'] = شماره وضعیت
2- نحوه بازگشت مقادیر از وب سایت

پس از اینکه کاربر بر روی کلید متصل به آدرس وب سایت ضربه زد، مقادیر فوق به وب سایت ارسال خواهد شد. در وب سایت با بررسی این مقادیر یک خروجی به صورت JSON چاپ خواهد شد که این خروجی توسط کریت پردازش شده و در خصوص واکنش متناسب تصمیم گیری می شود.

شما در خروجی می توانید یک یا چند پست (نهایتا 10 پست) به کریت ارسال کنید. هر پست باید از الگوی زیر پیروی کند:

$newContent = [
   'text' => $text, // مقدار متنی پاسخ
   'data' => $mediaUrl, //مقدار غیر متنی پاسخ. حتما به صورت آدرس وبی یک رسانه مثلا عکس، ویدیو و ... باید باشد یا اینکه مقدار آن خالی باشد
   'type' => $type, //نوع پاسخ
   'inline_keyboard' => $inlineKeyboard, //به صورت آرایه ای از آرایه ای از کلید ها
];
  مقادیر قابل قبول برای فیلد type این مقادیر می باشد: text, photo, video, document, audio, voice, document

   نمونه ای از صفحه کلید به صورت زیر است:

$keyboard = [
   0 => ['key1', 'key2', 'key3'],
   1 => ['key4', 'key5', 'key6'],
];
  صفحه کلیدی که در اینجا به همراه پست قرار می گیرد به صورت کلیدهای شیشه ای در زیر هر پست قرار داده خواهد شد. برای قرار دادن کلید معمولی در پاسخ شما باید آن را در فیلد دیگری قرار دهید که در ادامه توضیح داده خواهد شد.

پس ار اینکه هر پست را با استفاده از الگوی فوق آماده کردید لازم است که این مقادیر یک آرایه یا ایندکس content قرار داده شود. به عنوان نمونه:

$apiData['content'] = [
   $newContent1,
   $newContent2,
   $newContent3,
];
برای قرار دادن صفحه کلید معمولی بعد از ارسال پست با پست ها در ربات باید صفحه کلید معمولی را در آرایه ای که قرار است برگشت داده شود تحت ایندکس keyboard قرار دهید. یعنی:

$apiData['keyboard'] = $keyboard
در نهایت مقدار apiData را به صورت JSON در خروجی چاپ کنید. یعنی:

header('Content-type: appication/json');
echo json_encode( $apiData );
3- ادامه ارتباط با کاربر

پس از اینکه کاربر برای اولین بار بر روی کلید ضربه زد، مقادیر اشاره شده در بالا با state = 0 به وب سایت ارسال می شود. در وب سایت می توانید در زمان ارسال مقادیر به خروجی با تنظیم متغیری به نام return_user_answer در مقدار خروجی (apiData) از کریت بخواهید که واکنش کاربر شامل ضربه زدن بر روی کلید و یا ارسال پیام را به آدرس تنظیم شده در این متغیر ارسال کند.

$apiData['return_user_answer] = $returnUrlOrTrueOrFalse;
مقدار return_user_answer می تواند true و یا false و یا یک آدرس وبی باشد. در صورتی که true باشد کریت کریت واکنش کاربر را به همان آدرسی که کلید به آن متصل است ارسال می کند. در صورتی که حاوی یک آدرس وبی باشد به آن آدرس ارسال می کند و در صورتی هم که مقدار false داشته باشد ارسالی انجام نخواهد داد.

4-تنظیم شماره وضعیت و مقادیر سفارشی

همچنین شما این قابلیت را دارید که در ادامه ارتباط با کاربر در مقادیر بازگشتی به کریت یک عدد به عنوان شماره وضعیت و یا مقدار یا مقادیری را به عنوان مقادیر سفارشی به کریت ارسال کنید. در این صورت کریت این مقادیر را در زمان ارسال واکنش بعدی کاربر به وب سایت ارسال خواهد کرد.

در صورتی که مقدار state تنظیم نشود کریت به صورت خودکار در هر بار ارسال واکنش به وب سایت مقدار state قبلی را با شروع از 0 یک واحد اضافه خواهد کرد.

$apiData['state'] = $state;
$apiData['session'] = $session;
