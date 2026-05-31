---
description: PROGRESS.mdの評価をもとに次のタスクを適応的に決定し、TASK.mdを生成する
---

# /next — 次タスクの適応的決定・生成

## あなたのタスク

### Step 1: 現状の確認

以下を読む：
- `.study/_session/current_session.md`（最後のレビュー結果・レベル）
- `.study/topics/{topic}/PROGRESS.md`（これまでの評価推移）
- `.study/topics/{topic}/LEARNING_PLAN.md`（全体の学習計画）

### Step 2: 適応的タスク選択

直近のレビューレベルに応じて次のタスクを選ぶ。

```
Level A → LEARNING_PLANの次の項目を通常難易度で出題
Level B → 同フェーズの次の項目を同難易度で出題
Level C → 同じ概念を別角度から出題（応用ではなく類似問題）
Level D → 前タスクに関連する前提概念を確認する小タスクを出題
```

LEARNING_PLANのすべての項目が完了した場合は、次のトピックへの移行を提案する。

### Step 3: TASK.md の生成

`.study/topics/{topic}/{NN}_{task_name}/TASK.md` を新規作成する。
`.study/_templates/TASK_template.md` を参照すること。

タスクは**プロジェクトの実際のコードに関連付ける**こと：
- 抽象的な練習問題ではなく、実際のファイルを参照させる
- 「このファイルの〇〇の部分を改善せよ」「この機能にテストを追加せよ」など

### Step 4: タスクの口頭説明

TASK.mdの内容をユーザーにわかりやすく説明する：
- このタスクで何を学ぶか
- どこに着手するか（参照すべきファイルなど）
- 完了の目安

### Step 5: current_session.md の更新

```
Status: Assigned
Current Task: {新しいタスク名}
Task Started: {日付}
```

### Step 6: 選択理由の明示

**必ず**なぜこのタスクを選んだかを伝える。例：
- 「前回Bだったので、同フェーズの次の項目を出題します」
- 「前回Aだったので、次のトピックに進みます。お疲れ様でした！」
- 「前回Cだったので、同じ概念を別の角度から練習します」
