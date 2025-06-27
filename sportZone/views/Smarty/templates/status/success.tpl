{extends file=$layout}
{assign var="page_title" value="Successo"}

{block name="styles"}
    <style>
        .centered-success-wrapper {
            min-height: 60vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f9fafb;
        }
        .simple-success-box {
            background: #ffffff;
            color: #1f2937; /* gray-800 */
            padding: 2rem 2.5rem;
            border-radius: 12px;
            max-width: 400px;
            width: 100%;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04); /* Soft shadow */
        }
        .simple-success-box h1 {
            margin: 0 0 1rem 0;
            font-size: 2rem;
            color: #111827; /* gray-900 */
        }
        .simple-success-box p {
            margin-bottom: 1.5rem;
            font-size: 1.05rem;
            color: #4b5563; /* gray-600 */
        }
        .simple-success-box button {
            background: #3b82f6; /* blue-500 */
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }
        .simple-success-box button:hover {
            background: #2563eb; /* blue-600 */
        }
    </style>
{/block}

{block name="content"}
    <div class="centered-success-wrapper">
        <div class="simple-success-box">
            <h1>Successo</h1>
            <p>{$success_message|escape}</p>
            <button type="button" onclick="history.back()">Continua</button>
        </div>
    </div>
{/block}
