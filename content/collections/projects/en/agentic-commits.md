---
id: 2fd73b92-39c4-44ef-abc1-38a8f72fe4d7
blueprint: projects
title: 'Agentic Commits'
subtitle: 'A commit specification that AI agents and humans can read, understand, and act on'
emoji: 🔀
link: 'https://github.com/deligoez/agentic-commits'
order: 1
has_detail_page: true
show_toc: true
updated_by: b8f3533e-0fcf-42b9-a3d8-c8691deaf917
updated_at: 1768818403
toc_levels:
  - 1
content:
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        marks:
          -
            type: bold
        text: 'A specification'
      -
        type: text
        text: ' for commit messages that AI agents can read, understand, and act on.'
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        marks:
          -
            type: bold
        text: 'Plus a skill'
      -
        type: text
        text: ' that implements hunk-splitting and atomic commit workflows.'
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: 'Like '
      -
        type: text
        marks:
          -
            type: link
            attrs:
              href: 'https://www.conventionalcommits.org'
              rel: null
              target: _blank
              title: null
        text: 'Conventional Commits'
      -
        type: text
        text: ', but optimized for agent capabilities: Resume, Review, Handoff, and Code Review.'
  -
    type: horizontalRule
  -
    type: heading
    attrs:
      textAlign: left
      level: 1
    content:
      -
        type: text
        text: 'The Problem'
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: 'Your git history has all the information. But no one can use it:'
  -
    type: heading
    attrs:
      textAlign: left
      level: 3
    content:
      -
        type: text
        text: "Agents can't Resume"
  -
    type: set
    attrs:
      id: resume01u
      values:
        type: thought
        content:
          -
            type: paragraph
            content:
              -
                type: text
                text: '👤 Continue where we left off'
        position: center-left
  -
    type: set
    attrs:
      id: resume02a
      values:
        type: thought
        content:
          -
            type: paragraph
            content:
              -
                type: text
                text: 'What would you like me to help you with today? 🤖'
        position: center-right
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: 'Without '
      -
        type: text
        marks:
          -
            type: code
        text: '→ next'
      -
        type: text
        text: ", the agent doesn't know where you left off."
  -
    type: heading
    attrs:
      textAlign: left
      level: 3
    content:
      -
        type: text
        text: "Agents can't Review"
  -
    type: set
    attrs:
      id: review01u
      values:
        type: thought
        content:
          -
            type: paragraph
            content:
              -
                type: text
                text: '👤 Why did we add refresh tokens?'
        position: center-left
  -
    type: set
    attrs:
      id: review02a
      values:
        type: thought
        content:
          -
            type: paragraph
            content:
              -
                type: text
                text: "I don't have context from previous sessions. 🤖"
        position: center-right
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: 'Without '
      -
        type: text
        marks:
          -
            type: code
        text: (why)
      -
        type: text
        text: ', the decision rationale is lost.'
  -
    type: heading
    attrs:
      textAlign: left
      level: 3
    content:
      -
        type: text
        text: "New developers can't Handoff"
  -
    type: set
    attrs:
      id: handoff1u
      values:
        type: thought
        content:
          -
            type: paragraph
            content:
              -
                type: text
                text: "👤 What's been done so far?"
        position: center-left
  -
    type: set
    attrs:
      id: handoff2a
      values:
        type: thought
        content:
          -
            type: paragraph
            content:
              -
                type: text
                text: "I see 127 commits but the messages are 'fix', 'wip', 'updates'... 🤖"
        position: center-right
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: 'Without structured history, meaningful summaries are impossible.'
  -
    type: heading
    attrs:
      textAlign: left
      level: 3
    content:
      -
        type: text
        text: "Reviewers can't Code Review effectively"
  -
    type: set
    attrs:
      id: codrev1u
      values:
        type: thought
        content:
          -
            type: paragraph
            content:
              -
                type: text
                text: '👤 Is a null check the right fix here?'
        position: center-left
  -
    type: set
    attrs:
      id: codrev2c
      values:
        type: thought
        content:
          -
            type: paragraph
            content:
              -
                type: text
                text: 'Commit: "fix: add null check" 📝'
        position: center-right
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: 'Without '
      -
        type: text
        marks:
          -
            type: code
        text: (why)
      -
        type: text
        text: ", reviewers can't evaluate if the solution fits the problem."
  -
    type: horizontalRule
  -
    type: heading
    attrs:
      textAlign: left
      level: 1
    content:
      -
        type: text
        text: 'The Solution'
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: 'Structure your commits so anyone - agent or human - can read them and take action.'
  -
    type: codeBlock
    attrs:
      language: bash
    content:
      -
        type: text
        text: |
          $ git log --oneline -5
          f4a2b1c wip(AuthController): add logout (security) → token blacklist, rate limiting
          d4e5f6g feat(SessionManager): add refresh tokens (mid-task logout fix)
          a1b2c3d fix(SessionManager): validate user ID (silent auth failures)
          8c7d6e5 refactor(AuthService): extract token utils (code dedup)
          3b2a1c0 feat(AuthController): add login endpoint (user access)
  -
    type: horizontalRule
  -
    type: heading
    attrs:
      textAlign: left
      level: 1
    content:
      -
        type: text
        text: 'Four Capabilities'
  -
    type: table
    content:
      -
        type: tableRow
        content:
          -
            type: tableHeader
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: Capability
          -
            type: tableHeader
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: Reads
          -
            type: tableHeader
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: Agent
          -
            type: tableHeader
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: Human
      -
        type: tableRow
        content:
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    marks:
                      -
                        type: bold
                    text: Resume
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    marks:
                      -
                        type: code
                    text: '→ next'
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'Continue after crash'
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'Remember after vacation'
      -
        type: tableRow
        content:
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    marks:
                      -
                        type: bold
                    text: Review
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    marks:
                      -
                        type: code
                    text: (why)
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'Explain past decisions'
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'Understand why code exists'
      -
        type: tableRow
        content:
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    marks:
                      -
                        type: bold
                    text: Handoff
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'Full history'
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'New agent takes over'
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'New developer onboarding'
      -
        type: tableRow
        content:
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    marks:
                      -
                        type: bold
                    text: 'Code Review'
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    marks:
                      -
                        type: code
                    text: (why)
                  -
                    type: text
                    text: ' + diff'
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'AI evaluates approach'
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'Reviewer understands intent'
  -
    type: horizontalRule
  -
    type: heading
    attrs:
      textAlign: left
      level: 1
    content:
      -
        type: text
        text: 'The Format'
  -
    type: codeBlock
    attrs:
      language: text
    content:
      -
        type: text
        text: 'type(Scope): what (why) → next'
  -
    type: heading
    attrs:
      textAlign: left
      level: 2
    content:
      -
        type: text
        text: Elements
  -
    type: table
    content:
      -
        type: tableRow
        content:
          -
            type: tableHeader
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: Element
          -
            type: tableHeader
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: Purpose
          -
            type: tableHeader
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: Required
      -
        type: tableRow
        content:
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    marks:
                      -
                        type: bold
                    text: type
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'Categorize: feat, fix, wip, refactor, test, docs, chore'
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: Always
      -
        type: tableRow
        content:
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    marks:
                      -
                        type: bold
                    text: Scope
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'Locate: file name or component'
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: Always
      -
        type: tableRow
        content:
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    marks:
                      -
                        type: bold
                    text: what
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'Describe: imperative action'
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: Always
      -
        type: tableRow
        content:
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    marks:
                      -
                        type: bold
                    text: (why)
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'Explain: motivation - enables Review & Code Review'
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: Always
      -
        type: tableRow
        content:
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    marks:
                      -
                        type: bold
                    text: '→ next'
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'Continue: tasks - enables Resume'
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'WIP only'
  -
    type: heading
    attrs:
      textAlign: left
      level: 2
    content:
      -
        type: text
        text: Types
  -
    type: table
    content:
      -
        type: tableRow
        content:
          -
            type: tableHeader
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: Type
          -
            type: tableHeader
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: Use
          -
            type: tableHeader
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'Needs → next?'
      -
        type: tableRow
        content:
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    marks:
                      -
                        type: code
                    text: feat
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'Completed feature'
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'No'
      -
        type: tableRow
        content:
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    marks:
                      -
                        type: code
                    text: wip
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'Work in progress'
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    marks:
                      -
                        type: bold
                    text: 'Yes'
      -
        type: tableRow
        content:
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    marks:
                      -
                        type: code
                    text: fix
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'Bug fix'
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'No'
      -
        type: tableRow
        content:
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    marks:
                      -
                        type: code
                    text: refactor
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'Code restructure'
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'No'
      -
        type: tableRow
        content:
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    marks:
                      -
                        type: code
                    text: test
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: Tests
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'No'
      -
        type: tableRow
        content:
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    marks:
                      -
                        type: code
                    text: docs
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: Documentation
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'No'
      -
        type: tableRow
        content:
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    marks:
                      -
                        type: code
                    text: chore
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'Config, dependencies'
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'No'
  -
    type: heading
    attrs:
      textAlign: left
      level: 2
    content:
      -
        type: text
        text: Examples
  -
    type: codeBlock
    attrs:
      language: bash
    content:
      -
        type: text
        text: |
          # Completed feature - reviewer knows it's done
          feat(AuthService): add JWT validation (token expiry protection)

          # Work in progress - agent knows what's next
          wip(AuthController): add logout endpoint (security) → token blacklist, rate limiting

          # Bug fix - reviewer can evaluate if solution fits problem
          fix(SessionManager): validate user ID (users crashed on empty session)

          # Refactor - reviewer understands the motivation
          refactor(UserService): extract token utils (code was duplicated in 3 places)
  -
    type: horizontalRule
  -
    type: heading
    attrs:
      textAlign: left
      level: 1
    content:
      -
        type: text
        text: 'Code Review: Why (why) Matters'
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: 'Without '
      -
        type: text
        marks:
          -
            type: code
        text: (why)
      -
        type: text
        text: ', reviewers can only check:'
  -
    type: bulletList
    content:
      -
        type: listItem
        content:
          -
            type: paragraph
            attrs:
              textAlign: left
            content:
              -
                type: text
                text: 'Is the code syntactically correct? Yes'
      -
        type: listItem
        content:
          -
            type: paragraph
            attrs:
              textAlign: left
            content:
              -
                type: text
                text: 'Are there obvious bugs? Yes'
      -
        type: listItem
        content:
          -
            type: paragraph
            attrs:
              textAlign: left
            content:
              -
                type: text
                text: 'Is this the right approach for the problem? No'
      -
        type: listItem
        content:
          -
            type: paragraph
            attrs:
              textAlign: left
            content:
              -
                type: text
                text: 'Is there a better solution? No'
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: 'With '
      -
        type: text
        marks:
          -
            type: code
        text: (why)
      -
        type: text
        text: ', reviewers can evaluate:'
  -
    type: codeBlock
    attrs:
      language: bash
    content:
      -
        type: text
        text: |
          # Without (why) - reviewer guesses the problem
          fix(AuthService): add null check

          # With (why) - reviewer can evaluate if null check is the right solution
          fix(AuthService): add null check (users crashed on empty forms)
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: 'Now the reviewer can ask: '
      -
        type: text
        marks:
          -
            type: italic
        text: '"Is a null check the best fix for users crashing on empty forms? Or should we validate earlier?"'
  -
    type: horizontalRule
  -
    type: heading
    attrs:
      textAlign: left
      level: 1
    content:
      -
        type: text
        text: 'Atomic Commits'
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: 'Agents and reviewers parse commits one by one. Make each one self-contained:'
  -
    type: bulletList
    content:
      -
        type: listItem
        content:
          -
            type: paragraph
            attrs:
              textAlign: left
            content:
              -
                type: text
                marks:
                  -
                    type: bold
                text: 'One logical change per commit'
              -
                type: text
                text: " - Don't mix unrelated changes"
      -
        type: listItem
        content:
          -
            type: paragraph
            attrs:
              textAlign: left
            content:
              -
                type: text
                marks:
                  -
                    type: bold
                text: 'One file per commit'
              -
                type: text
                text: ' - Different files = separate commits (unless directly dependent)'
      -
        type: listItem
        content:
          -
            type: paragraph
            attrs:
              textAlign: left
            content:
              -
                type: text
                marks:
                  -
                    type: bold
                text: 'Hunk-level splitting'
              -
                type: text
                text: ' - Same file can have multiple commits if changes are independent'
      -
        type: listItem
        content:
          -
            type: paragraph
            attrs:
              textAlign: left
            content:
              -
                type: text
                marks:
                  -
                    type: bold
                text: 'Commit order'
              -
                type: text
                text: ' - fixes → refactors → features'
  -
    type: heading
    attrs:
      textAlign: left
      level: 2
    content:
      -
        type: text
        text: 'How Hunk Splitting Works'
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: 'A '
      -
        type: text
        marks:
          -
            type: bold
        text: hunk
      -
        type: text
        text: ' is a contiguous block of changes in a file. When one file has multiple unrelated changes, the skill splits them into separate commits:'
  -
    type: codeBlock
    attrs:
      language: bash
    content:
      -
        type: text
        text: |
          # Before: One file with mixed changes
          SessionManager.ts:
            line 12:  + if (!userId) throw new Error('Invalid user')    ← fix
            line 15:  + this.logger.debug('Session validated')          ← fix
            ...
            line 89:  + async refresh() { return this.renewToken() }    ← feat
            line 94:  + this.lastRefresh = Date.now()                   ← feat

          # After: Skill uses git add -p to split hunks
          Commit 1: fix(SessionManager): validate user ID (users crashed on empty session)
            → only lines 12, 15

          Commit 2: feat(SessionManager): add refresh capability (tokens expired mid-task)
            → only lines 89, 94
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: 'Each commit contains only related lines, even from the same file. Reviewers see focused changes instead of mixed diffs.'
  -
    type: heading
    attrs:
      textAlign: left
      level: 2
    content:
      -
        type: text
        text: 'Different Files, Same Type'
  -
    type: codeBlock
    attrs:
      language: bash
    content:
      -
        type: text
        text: |
          # Bad: reviewer can't tell which file had which problem
          fix(AuthService,UserController): add validation (prevent errors)

          # Good: reviewer knows exactly what was fixed where
          fix(AuthService): add validation (empty credentials caused crash)
          fix(UserController): add validation (invalid IDs caused 500 error)
  -
    type: horizontalRule
  -
    type: heading
    attrs:
      textAlign: left
      level: 1
    content:
      -
        type: text
        text: Benchmark
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: 'We tested agent comprehension across multiple AI models on Vite PR #21235.'
  -
    type: heading
    attrs:
      textAlign: left
      level: 2
    content:
      -
        type: text
        text: 'Format Comparison'
  -
    type: table
    content:
      -
        type: tableRow
        content:
          -
            type: tableHeader
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: Format
          -
            type: tableHeader
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'Agent Accuracy'
      -
        type: tableRow
        content:
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'Plain commits'
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 38.7%
      -
        type: tableRow
        content:
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'Conventional commits'
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 48.0%
      -
        type: tableRow
        content:
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: '+ WHY '
                  -
                    type: text
                    marks:
                      -
                        type: code
                    text: (reason)
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 51.5%
      -
        type: tableRow
        content:
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    marks:
                      -
                        type: bold
                    text: '+ WHY + NEXT + Scope'
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    marks:
                      -
                        type: bold
                    text: 76.6%
  -
    type: heading
    attrs:
      textAlign: left
      level: 2
    content:
      -
        type: text
        text: 'What Each Element Adds'
  -
    type: table
    content:
      -
        type: tableRow
        content:
          -
            type: tableHeader
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: Element
          -
            type: tableHeader
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: Enables
          -
            type: tableHeader
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: Impact
      -
        type: tableRow
        content:
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    marks:
                      -
                        type: bold
                    text: '→ next'
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: Resume
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: +12%
      -
        type: tableRow
        content:
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    marks:
                      -
                        type: bold
                    text: (why)
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'Review, Code Review'
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: +3.5%
      -
        type: tableRow
        content:
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    marks:
                      -
                        type: bold
                    text: Atomic
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'All capabilities'
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'Clean history'
  -
    type: horizontalRule
  -
    type: heading
    attrs:
      textAlign: left
      level: 1
    content:
      -
        type: text
        text: FAQ
  -
    type: heading
    attrs:
      textAlign: left
      level: 2
    content:
      -
        type: text
        text: 'Why not just read the code?'
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: 'For many tasks, reading the codebase is enough. But some information only exists in commits:'
  -
    type: table
    content:
      -
        type: tableRow
        content:
          -
            type: tableHeader
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: Information
          -
            type: tableHeader
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'In codebase?'
          -
            type: tableHeader
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'In commits?'
      -
        type: tableRow
        content:
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'What code does'
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'Yes'
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'No'
      -
        type: tableRow
        content:
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    marks:
                      -
                        type: bold
                    text: 'Why it was written'
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'No (sometimes comments)'
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'Yes '
                  -
                    type: text
                    marks:
                      -
                        type: code
                    text: (why)
      -
        type: tableRow
        content:
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    marks:
                      -
                        type: bold
                    text: "What's next"
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'No'
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'Yes '
                  -
                    type: text
                    marks:
                      -
                        type: code
                    text: '→ next'
      -
        type: tableRow
        content:
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    marks:
                      -
                        type: bold
                    text: 'Is it finished?'
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'No (guess)'
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'Yes '
                  -
                    type: text
                    marks:
                      -
                        type: code
                    text: wip
                  -
                    type: text
                    text: ' vs '
                  -
                    type: text
                    marks:
                      -
                        type: code
                    text: feat
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: 'Commits are '
      -
        type: text
        marks:
          -
            type: bold
        text: 'metadata about your code'
      -
        type: text
        text: '. They complement reading code, not replace it.'
  -
    type: heading
    attrs:
      textAlign: left
      level: 2
    content:
      -
        type: text
        text: 'How is this different from Conventional Commits?'
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: 'Agentic Commits extends Conventional Commits with two additions:'
  -
    type: table
    content:
      -
        type: tableRow
        content:
          -
            type: tableHeader
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: Element
          -
            type: tableHeader
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: Conventional
          -
            type: tableHeader
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: Agentic
      -
        type: tableRow
        content:
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    marks:
                      -
                        type: code
                    text: (why)
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'Optional in body'
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    marks:
                      -
                        type: bold
                    text: 'Required in title'
      -
        type: tableRow
        content:
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    marks:
                      -
                        type: code
                    text: '→ next'
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'Not defined'
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    marks:
                      -
                        type: bold
                    text: 'Required for WIP'
  -
    type: codeBlock
    attrs:
      language: bash
    content:
      -
        type: text
        text: |
          # Conventional
          feat(auth): add JWT validation

          # Agentic - adds why and next
          feat(AuthService): add JWT validation (token expiry protection)
          wip(AuthController): add logout (security) → token blacklist, rate limiting
  -
    type: heading
    attrs:
      textAlign: left
      level: 2
    content:
      -
        type: text
        text: 'Is this only for AI agents?'
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: 'No. All four capabilities benefit both agents and humans. See the capabilities table above.'
  -
    type: heading
    attrs:
      textAlign: left
      level: 2
    content:
      -
        type: text
        text: 'What if I forget to add (why)?'
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: 'The commit loses value for Review and Code Review. Without '
      -
        type: text
        marks:
          -
            type: code
        text: (why)
      -
        type: text
        text: ':'
  -
    type: bulletList
    content:
      -
        type: listItem
        content:
          -
            type: paragraph
            attrs:
              textAlign: left
            content:
              -
                type: text
                text: "Reviewers can't evaluate if the solution fits the problem"
      -
        type: listItem
        content:
          -
            type: paragraph
            attrs:
              textAlign: left
            content:
              -
                type: text
                text: "Future developers (or agents) can't understand the motivation"
      -
        type: listItem
        content:
          -
            type: paragraph
            attrs:
              textAlign: left
            content:
              -
                type: text
                text: "You're back to guessing from code alone"
  -
    type: heading
    attrs:
      textAlign: left
      level: 2
    content:
      -
        type: text
        text: 'Should I use commit body?'
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: 'Title-only format is usually enough. Our benchmark showed no accuracy difference between title-only and title+body formats. Use body only for complex changes that need extra context.'
  -
    type: heading
    attrs:
      textAlign: left
      level: 2
    content:
      -
        type: text
        text: 'Can I use → next on non-WIP commits?'
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: 'No. '
      -
        type: text
        marks:
          -
            type: code
        text: '→ next'
      -
        type: text
        text: ' is only for '
      -
        type: text
        marks:
          -
            type: code
        text: wip
      -
        type: text
        text: ' commits. Completed work ('
      -
        type: text
        marks:
          -
            type: code
        text: feat
      -
        type: text
        text: ', '
      -
        type: text
        marks:
          -
            type: code
        text: fix
      -
        type: text
        text: ", etc.) shouldn't have next steps - if there are next steps, it's not done yet."
  -
    type: heading
    attrs:
      textAlign: left
      level: 2
    content:
      -
        type: text
        text: 'What if the implementing and committing agents are different?'
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: 'This affects '
      -
        type: text
        marks:
          -
            type: bold
        text: Resume
      -
        type: text
        text: ' capability only. The agent writing commits must have implementation context to know '
      -
        type: text
        marks:
          -
            type: code
        text: '→ next'
      -
        type: text
        text: .
  -
    type: table
    content:
      -
        type: tableRow
        content:
          -
            type: tableHeader
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: Capability
          -
            type: tableHeader
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'Different agents?'
          -
            type: tableHeader
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: Reason
      -
        type: tableRow
        content:
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: Resume
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'Needs same agent'
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    marks:
                      -
                        type: code
                    text: '→ next'
                  -
                    type: text
                    text: ' requires knowing the plan'
      -
        type: tableRow
        content:
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: Review
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: Works
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    marks:
                      -
                        type: code
                    text: (why)
                  -
                    type: text
                    text: ' can be inferred from diff'
      -
        type: tableRow
        content:
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: Handoff
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: Works
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'Full history is visible'
      -
        type: tableRow
        content:
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'Code Review'
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: Works
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    marks:
                      -
                        type: code
                    text: (why)
                  -
                    type: text
                    text: ' + diff is enough'
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        marks:
          -
            type: bold
        text: 'Rule:'
      -
        type: text
        text: ' Never guess '
      -
        type: text
        marks:
          -
            type: code
        text: '→ next'
      -
        type: text
        text: ". If you don't have implementation context, use "
      -
        type: text
        marks:
          -
            type: code
        text: feat
      -
        type: text
        text: ' instead of '
      -
        type: text
        marks:
          -
            type: code
        text: wip
      -
        type: text
        text: .
  -
    type: heading
    attrs:
      textAlign: left
      level: 2
    content:
      -
        type: text
        text: 'Can I apply this to an existing project?'
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: "Yes. Start using the format for new commits. You don't need to rewrite history. Over time, your recent commits will be agent-readable while older ones remain as-is."
  -
    type: heading
    attrs:
      textAlign: left
      level: 2
    content:
      -
        type: text
        text: 'How atomic should my commits be?'
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: "One logical change, one file (unless directly dependent). If you're tempted to write "
      -
        type: text
        marks:
          -
            type: italic
        text: '"and"'
      -
        type: text
        text: ' in your commit message, split it into two commits.'
  -
    type: horizontalRule
  -
    type: heading
    attrs:
      textAlign: left
      level: 1
    content:
      -
        type: text
        text: Install
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: 'Choose your agent below. The full skill includes hunk-splitting workflows and atomic commit automation. For a quick start, see Specification Only at the bottom.'
  -
    type: heading
    attrs:
      textAlign: left
      level: 2
    content:
      -
        type: text
        text: 'Claude Code'
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        marks:
          -
            type: bold
        text: '1. Marketplace (recommended)'
  -
    type: codeBlock
    attrs:
      language: bash
    content:
      -
        type: text
        text: |
          /plugin marketplace add deligoez/agentic-commits
          /plugin install agentic-commit@agentic-commits
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        marks:
          -
            type: bold
        text: '2. Manual - Project-level'
      -
        type: text
        text: ' (tracked in git, team-wide)'
  -
    type: codeBlock
    attrs:
      language: bash
    content:
      -
        type: text
        text: |
          mkdir -p .claude/skills/agentic-commit
          curl -sL https://github.com/deligoez/agentic-commits/archive/main.tar.gz | \
            tar -xz --strip-components=2 -C .claude/skills/agentic-commit \
            agentic-commits-main/skills/agentic-commit
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        marks:
          -
            type: bold
        text: '3. Manual - User-level'
      -
        type: text
        text: ' (all your projects)'
  -
    type: codeBlock
    attrs:
      language: bash
    content:
      -
        type: text
        text: |
          mkdir -p ~/.claude/skills/agentic-commit
          curl -sL https://github.com/deligoez/agentic-commits/archive/main.tar.gz | \
            tar -xz --strip-components=2 -C ~/.claude/skills/agentic-commit \
            agentic-commits-main/skills/agentic-commit
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: 'Then add to '
      -
        type: text
        marks:
          -
            type: code
        text: CLAUDE.md
      -
        type: text
        text: ': '
      -
        type: text
        marks:
          -
            type: code
        text: 'Use the agentic-commit skill for all commits.'
  -
    type: heading
    attrs:
      textAlign: left
      level: 2
    content:
      -
        type: text
        text: Codex
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        marks:
          -
            type: bold
        text: '1. Repo-level'
  -
    type: codeBlock
    attrs:
      language: bash
    content:
      -
        type: text
        text: |
          mkdir -p .codex/skills/agentic-commit
          curl -sL https://github.com/deligoez/agentic-commits/archive/main.tar.gz | \
            tar -xz --strip-components=2 -C .codex/skills/agentic-commit \
            agentic-commits-main/skills/agentic-commit
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        marks:
          -
            type: bold
        text: '2. User-level'
  -
    type: codeBlock
    attrs:
      language: bash
    content:
      -
        type: text
        text: |
          mkdir -p ~/.codex/skills/agentic-commit
          curl -sL https://github.com/deligoez/agentic-commits/archive/main.tar.gz | \
            tar -xz --strip-components=2 -C ~/.codex/skills/agentic-commit \
            agentic-commits-main/skills/agentic-commit
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: 'Invoke with '
      -
        type: text
        marks:
          -
            type: code
        text: /skills
      -
        type: text
        text: ' or '
      -
        type: text
        marks:
          -
            type: code
        text: $agentic-commit
      -
        type: text
        text: '. Add to '
      -
        type: text
        marks:
          -
            type: code
        text: AGENTS.md
      -
        type: text
        text: ' for automatic invocation.'
  -
    type: heading
    attrs:
      textAlign: left
      level: 2
    content:
      -
        type: text
        text: Cursor
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        marks:
          -
            type: bold
        text: '1. Remote Rule (Settings)'
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: 'Settings → Rules → Add Rule → Remote Rule (GitHub) → '
      -
        type: text
        marks:
          -
            type: code
        text: deligoez/agentic-commits
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        marks:
          -
            type: bold
        text: '2. Manual - Project-level'
  -
    type: codeBlock
    attrs:
      language: bash
    content:
      -
        type: text
        text: |
          mkdir -p .cursor/skills/agentic-commit
          curl -sL https://github.com/deligoez/agentic-commits/archive/main.tar.gz | \
            tar -xz --strip-components=2 -C .cursor/skills/agentic-commit \
            agentic-commits-main/skills/agentic-commit
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        marks:
          -
            type: bold
        text: '3. Manual - User-level'
  -
    type: codeBlock
    attrs:
      language: bash
    content:
      -
        type: text
        text: |
          mkdir -p ~/.cursor/skills/agentic-commit
          curl -sL https://github.com/deligoez/agentic-commits/archive/main.tar.gz | \
            tar -xz --strip-components=2 -C ~/.cursor/skills/agentic-commit \
            agentic-commits-main/skills/agentic-commit
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: 'Skills auto-discovered at startup. Invoke manually with '
      -
        type: text
        marks:
          -
            type: code
        text: /
      -
        type: text
        text: ' in Agent chat. Also supports '
      -
        type: text
        marks:
          -
            type: code
        text: .claude/skills/
      -
        type: text
        text: .
  -
    type: heading
    attrs:
      textAlign: left
      level: 2
    content:
      -
        type: text
        text: Amp
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        marks:
          -
            type: bold
        text: '1. Workspace-level'
  -
    type: codeBlock
    attrs:
      language: bash
    content:
      -
        type: text
        text: |
          mkdir -p .agents/skills/agentic-commit
          curl -sL https://github.com/deligoez/agentic-commits/archive/main.tar.gz | \
            tar -xz --strip-components=2 -C .agents/skills/agentic-commit \
            agentic-commits-main/skills/agentic-commit
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        marks:
          -
            type: bold
        text: '2. User-level'
  -
    type: codeBlock
    attrs:
      language: bash
    content:
      -
        type: text
        text: |
          mkdir -p ~/.config/agents/skills/agentic-commit
          curl -sL https://github.com/deligoez/agentic-commits/archive/main.tar.gz | \
            tar -xz --strip-components=2 -C ~/.config/agents/skills/agentic-commit \
            agentic-commits-main/skills/agentic-commit
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: 'Add guidance to '
      -
        type: text
        marks:
          -
            type: code
        text: AGENTS.md
      -
        type: text
        text: '. Amp auto-loads skills via '
      -
        type: text
        marks:
          -
            type: code
        text: load_skill
      -
        type: text
        text: ' tool.'
  -
    type: heading
    attrs:
      textAlign: left
      level: 2
    content:
      -
        type: text
        text: Antigravity
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        marks:
          -
            type: bold
        text: '1. Workspace-level'
  -
    type: codeBlock
    attrs:
      language: bash
    content:
      -
        type: text
        text: |
          mkdir -p .agent/skills/agentic-commit
          curl -sL https://github.com/deligoez/agentic-commits/archive/main.tar.gz | \
            tar -xz --strip-components=2 -C .agent/skills/agentic-commit \
            agentic-commits-main/skills/agentic-commit
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        marks:
          -
            type: bold
        text: '2. Global'
  -
    type: codeBlock
    attrs:
      language: bash
    content:
      -
        type: text
        text: |
          mkdir -p ~/.gemini/antigravity/skills/agentic-commit
          curl -sL https://github.com/deligoez/agentic-commits/archive/main.tar.gz | \
            tar -xz --strip-components=2 -C ~/.gemini/antigravity/skills/agentic-commit \
            agentic-commits-main/skills/agentic-commit
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: 'Auto-discovered from '
      -
        type: text
        marks:
          -
            type: code
        text: .agent/skills/
      -
        type: text
        text: .
  -
    type: heading
    attrs:
      textAlign: left
      level: 2
    content:
      -
        type: text
        text: OpenCode
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        marks:
          -
            type: bold
        text: '1. Project-level'
  -
    type: codeBlock
    attrs:
      language: bash
    content:
      -
        type: text
        text: |
          mkdir -p .opencode/skill/agentic-commit
          curl -sL https://github.com/deligoez/agentic-commits/archive/main.tar.gz | \
            tar -xz --strip-components=2 -C .opencode/skill/agentic-commit \
            agentic-commits-main/skills/agentic-commit
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        marks:
          -
            type: bold
        text: '2. User-level'
  -
    type: codeBlock
    attrs:
      language: bash
    content:
      -
        type: text
        text: |
          mkdir -p ~/.config/opencode/skill/agentic-commit
          curl -sL https://github.com/deligoez/agentic-commits/archive/main.tar.gz | \
            tar -xz --strip-components=2 -C ~/.config/opencode/skill/agentic-commit \
            agentic-commits-main/skills/agentic-commit
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: 'Skills loaded on-demand. Also supports '
      -
        type: text
        marks:
          -
            type: code
        text: .claude/skills/
      -
        type: text
        text: .
  -
    type: heading
    attrs:
      textAlign: left
      level: 2
    content:
      -
        type: text
        text: 'Other Agents / Specification Only'
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: 'Add to your config file ('
      -
        type: text
        marks:
          -
            type: code
        text: CLAUDE.md
      -
        type: text
        text: ', '
      -
        type: text
        marks:
          -
            type: code
        text: AGENTS.md
      -
        type: text
        text: ', '
      -
        type: text
        marks:
          -
            type: code
        text: .cursorrules
      -
        type: text
        text: ', or system prompt):'
  -
    type: codeBlock
    attrs:
      language: markdown
    content:
      -
        type: text
        text: |
          Commit format: type(Scope): what (why) → next

          Elements:
          - type: feat/fix/wip/refactor/test/docs/chore
          - Scope: file name or component
          - (why): motivation - enables Review and Code Review
          - → next: continuation - enables Resume (wip only)

          Rules:
          - One logical change per commit
          - One file per commit (unless directly dependent)
          - Order: fixes → refactors → features
  -
    type: heading
    attrs:
      textAlign: left
      level: 2
    content:
      -
        type: text
        text: Summary
  -
    type: table
    content:
      -
        type: tableRow
        content:
          -
            type: tableHeader
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: Agent
          -
            type: tableHeader
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'Best Method'
          -
            type: tableHeader
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'Project Path'
          -
            type: tableHeader
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: Config
      -
        type: tableRow
        content:
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'Claude Code'
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: Marketplace
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    marks:
                      -
                        type: code
                    text: .claude/skills/
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    marks:
                      -
                        type: code
                    text: CLAUDE.md
      -
        type: tableRow
        content:
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: Codex
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: Manual
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    marks:
                      -
                        type: code
                    text: .codex/skills/
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    marks:
                      -
                        type: code
                    text: AGENTS.md
      -
        type: tableRow
        content:
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: Cursor
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: 'Remote Rule'
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    marks:
                      -
                        type: code
                    text: .cursor/skills/
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    marks:
                      -
                        type: code
                    text: .cursorrules
      -
        type: tableRow
        content:
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: Amp
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: Manual
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    marks:
                      -
                        type: code
                    text: .agents/skills/
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    marks:
                      -
                        type: code
                    text: AGENTS.md
      -
        type: tableRow
        content:
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: Antigravity
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: Manual
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    marks:
                      -
                        type: code
                    text: .agent/skills/
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: '-'
      -
        type: tableRow
        content:
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: OpenCode
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: Manual
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    marks:
                      -
                        type: code
                    text: .opencode/skill/
          -
            type: tableCell
            attrs:
              colspan: 1
              rowspan: 1
              colwidth: null
            content:
              -
                type: paragraph
                attrs:
                  textAlign: left
                content:
                  -
                    type: text
                    text: '-'
---
